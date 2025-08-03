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
        // dd(Cache::forget($key_data_peserta));
        $data_peserta = Cache::remember($key_data_peserta, now()->addMinutes(10), function () {
            return \App\Models\Kelas::whereHas('peserta', function($query) {
                        $query->where('user_id', Auth::id());
                    })
                    ->with('periode', 'periode.unit', 'peserta')
                    ->latest()
                    ->take(3)
                    ->get();
        });

        $data_peserta_id = $data_peserta->pluck('id');

        $key_data_transaksi = 'data_transaksi_dashboard_' . Auth::id();
        $data_transaksi = Cache::remember($key_data_transaksi, now()->addMinutes(10), function () use ($data_peserta_id) {
            return Transaksi::whereIn('kelas_id', $data_peserta_id)
                        ->get()
                        ->where('status', '1')
                        ->mapWithKeys(function($item) {
                            return ['transaksi'.$item->kelas_id => $item->uuid];
                        })
                        ->toArray();
        });

        return view('dashboard', compact('user', 'data_peserta', 'data_transaksi'));
    }

    public function peserta($uuid) {

        $data_peserta = \App\Models\Kelas::whereHas('peserta', function($query) {
                        $query->where('user_id', Auth::id());
                    })
                    ->where('uuid', $uuid)
                    ->first();
        $data_biaya = \App\Models\Biaya::where('periode_id', $data_peserta->periode->id)->get();
        $data_pembayaran_peserta = \App\Models\Pembayaran::where('kelas_id', $data_peserta->id)->get();

        if (!$data_peserta) { abort(404); }

        $user = auth()->user();
        $roles = $this->roleRepo->getData();
        $user  = $this->userRepo->findData($user->id);

        return view('dashboard.peserta.peserta', compact('user', 'data_peserta', 'uuid', 'data_biaya', 'data_pembayaran_peserta'));
    }

    public function peserta_data(Request $request) {

        $key_data_peserta = 'data_peserta_data_' . Auth::id() . (isset($request->cari) ? '_'.$request->cari : '');
        $data_peserta = Cache::remember($key_data_peserta, now()->addMinutes(10), function () use ($request) {
            return \App\Models\Kelas::with('periode', 'periode.unit', 'peserta')
                    ->whereHas('peserta', function($query) {
                        $query->where('user_id', Auth::id());
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

        return view('dashboard.peserta.data', compact('data_peserta'));
    }

    public function peserta_riwayat_pembayaran() {

        $key_data_transaksi = 'data_transaksi_riwayat_' . Auth::id();
        $data_transaksi = Cache::remember($key_data_transaksi, now()->addMinutes(10), function () {
            return Transaksi::with('kelas', 'kelas.peserta', 'periode', 'periode.unit')
                            ->where('user_id', Auth::id())
                            ->latest()
                            ->paginate(10);
        });

        return view('dashboard.peserta.riwayat-pembayaran', compact('data_transaksi'));
    }

}
