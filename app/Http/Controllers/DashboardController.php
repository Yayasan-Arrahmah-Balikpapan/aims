<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interface\UserRepoInterface;
use App\Repositories\Interface\RoleRepoInterface;
use App\Models\Peserta;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use DebugBar;
use Illuminate\Support\Facades\DB;



class DashboardController extends Controller
{
    private $userRepo, $roleRepo;
    public function __construct(
        UserRepoInterface $userRepo,
        RoleRepoInterface $roleRepo
    ){
        $this->middleware('auth');
        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;
    }

    public function index() {

        $user = Auth::user();
        $roles = $this->roleRepo->getData();
        $user  = $this->userRepo->findData($user->id);

        $key_data_peserta = 'data_peserta_dashboard_' . Auth::id();
        // untuk spill peserta terbaru saja di depan
        // $data_peserta = Cache::remember($key_data_peserta, now()->addMinutes(0), function () {
        //     return \App\Models\Kelas::whereHas('peserta', function($query) {
        //                 $query->where('user_id', Auth::id());
        //             })
        //             ->with('periode', 'periode.unit', 'peserta')
        //             ->latest()
        //             ->take(2)
        //             ->get();
        // });

        $key_data_peserta_paginate = 'data_peserta_dashboard_paginate' . Auth::id();
        $data_peserta_paginate = Cache::remember($key_data_peserta_paginate, now()->addMinutes(0), function () {
            return \App\Models\Kelas::whereHas('peserta', function($query) {
                        $query->where('user_id', Auth::user()->id)
                                ->orWhere('phone_number', Auth::user()->phone_code.ltrim(Auth::user()->phone_number, '0'))
                        ;
                    })
                    ->with('periode', 'periode.unit', 'peserta')
                    ->latest()
                    ->paginate(10);
        });

        $data_peserta_id = $data_peserta_paginate->pluck('id');
        $key_data_transaksi = 'data_transaksi_dashboard_' . Auth::id();
        $data_transaksi = Cache::remember($key_data_transaksi, now()->addMinutes(0), function () {
            return Transaksi::with('kelas', 'kelas.peserta', 'periode', 'periode.unit', 'pembayaran')
                            ->where('user_id', Auth::id())
                            ->orWhereHas('peserta', function($query) {
                                $query->where('user_id', Auth::user()->id)
                                        ->orWhere('phone_number', Auth::user()->phone_code.ltrim(Auth::user()->phone_number, '0'))
                                ;
                            })
                            ->latest()
                            ->paginate(10);
        });

        // $key_data_pembayaran = 'data_pembayaran_dashboard_' . Auth::id();
        // $data_pembayaran = Cache::remember($key_data_pembayaran, now()->addMinutes(0), function () use ($data_peserta_id) {
        //     return \App\Models\Pembayaran::whereIn('kelas_id', $data_peserta_id)->get();
        // });

        // $data_biaya_periode = \App\Models\Biaya::whereIn('periode_id', $data_peserta_paginate->pluck('periode_id'))->get()->groupBy('periode_id');

        // $data_pembayaran = \App\Models\Pembayaran::whereIn('kelas_id', $data_peserta_id)->get()->toArray();

        $count_peserta = Cache::remember('count_peserta_dashboard_' . Auth::id(), now()->addMinutes(0), function () {
            return Peserta::where('user_id', Auth::id())->orWhere('phone_number', Auth::user()->phone_code.ltrim(Auth::user()->phone_number, '0'))->count();
        });

        $data_periode_pendaftaran =  \App\Models\Periode::
            where('kategori', 'reguler')
                ->whereHas('unit', function($query) {
                    $query->where('slug', 'tahsin');
                })
            ->where('aktifkan_pendaftaran',1)
            // ->latest()
            ->first();

        return view('dashboard-exp', compact('user',  'data_transaksi', 'data_peserta_paginate', 'count_peserta', 'data_periode_pendaftaran'));
    }

    public function peserta($uuid) {

        $data_peserta = \App\Models\Kelas::whereHas('peserta', function($query) {
                        $query->where('user_id', Auth::user()->id)
                                ->orWhere('phone_number', Auth::user()->phone_code.ltrim(Auth::user()->phone_number, '0'))
                        ;
                    })
                    ->where('uuid', $uuid)
                    ->first();
        $data_biaya = \App\Models\Biaya::where('periode_id', $data_peserta->periode->id)->get();
        $data_pembayaran_peserta = \App\Models\Pembayaran::where('kelas_id', $data_peserta->id)->get();

        $data_peserta_id = $data_peserta->pluck('id');
        $data_absensi_peserta = \App\Models\AbsensiPeserta::where('kelas_id', $data_peserta->id)
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->kelas_id.'-'.$item->data_absen->pertemuan_ke => $item->absen];
            })
            ->toArray();
        // dd($data_absensi_peserta);
        $data_transaksi = \App\Models\Transaksi::where('kelas_id', $data_peserta->id)->get();

        if (!$data_peserta) { abort(404); }

        $user = Auth::user();
        $roles = $this->roleRepo->getData();
        $user  = $this->userRepo->findData($user->id);

        return view('dashboard.peserta.peserta', compact('user', 'data_peserta', 'uuid', 'data_biaya', 'data_pembayaran_peserta', 'data_absensi_peserta', 'data_transaksi'));
    }

    public function peserta_data(Request $request) {

        $key_data_peserta = 'data_peserta_data_' . Auth::id() . (isset($request->cari) ? '_'.$request->cari : '');
        $data_peserta = Cache::remember($key_data_peserta, now()->addMinutes(0), function () use ($request) {
            return \App\Models\Kelas::with('periode', 'periode.unit', 'peserta')
                    ->whereHas('peserta', function($query) {
                        $query->where('user_id', Auth::user()->id)
                                ->orWhere('phone_number', Auth::user()->phone_code.ltrim(Auth::user()->phone_number, '0'))
                        ;
                    })
                    ->when($request->cari, function($query, $request) {
                        $query->whereHas('peserta', function($query) use ($request) {
                            $query->where('nama', 'like', "%$request->cari}%");
                        })
                        ->orWhere('nis_peserta', 'like', "%$request->cari%");
                    })
                    ->latest()
                    ->paginate(10);
        });

        $data_periode_pendaftaran =  \App\Models\Periode::
            where('kategori', 'reguler')
                ->whereHas('unit', function($query) {
                    $query->where('slug', 'tahsin');
                })
            ->where('aktifkan_pendaftaran',1)
            // ->latest()
            ->first();

        return view('dashboard.peserta.data', compact('data_peserta', 'data_periode_pendaftaran'));
    }

    public function peserta_riwayat_pembayaran() {

        $key_data_transaksi = 'data_transaksi_riwayat_' . Auth::id();
        $data_transaksi = Cache::remember($key_data_transaksi, now()->addMinutes(0), function () {
            return Transaksi::with('kelas', 'kelas.peserta', 'periode', 'periode.unit')
                            ->where('user_id', Auth::id())
                            ->orWhereHas('peserta', function($query) {
                                $query->where('user_id', Auth::user()->id)
                                        ->orWhere('phone_number', Auth::user()->phone_code.ltrim(Auth::user()->phone_number, '0'))
                                ;
                            })
                            ->latest()
                            ->paginate(10);
        });

        return view('dashboard.peserta.riwayat-pembayaran', compact('data_transaksi'));
    }

    public function agenda(Request $request) {

        return view('dashboard.peserta.agenda');
    }

}
