<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Interface\UserRepoInterface;
use App\Repositories\Interface\RoleRepoInterface;
use App\Models\Peserta;
use App\Models\Transaksi;



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

        $user = auth()->user();
        $roles = $this->roleRepo->getData();
        $user  = $this->userRepo->findData($user->id);

        $data_peserta = \App\Models\Kelas::whereHas('peserta', function($query) {
                        $query->where('user_id', auth()->user()->id);
                    })
                    ->latest()
                    ->paginate(5);

        $api_token = $user->createToken('api-token')->plainTextToken;

        $data_peserta_id = $data_peserta->pluck('id');

        $data_transaksi = Transaksi::whereIn('kelas_id', $data_peserta_id)
                        ->get()
                        ->where('status', '1')
                        ->mapWithKeys(function($item) {
                            return ['transaksi'.$item->kelas_id => $item->uuid];
                        })
                        ->toArray();

        // dd($api_token);

        return view('dashboard', compact('user', 'data_peserta', 'api_token', 'data_transaksi'));
    }

    public function peserta($uuid) {

        $data_peserta = \App\Models\Kelas::whereHas('peserta', function($query) {
                        $query->where('user_id', auth()->user()->id);
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

        $data_peserta = \App\Models\Kelas::whereHas('peserta', function($query) {
                        $query->where('user_id', auth()->user()->id);
                    })
                    ->when($request->cari, function($query, $request) {
                        $query->whereHas('peserta', function($query) use ($request) {
                            $query->where('nama', 'like', "%$request->cari}%");
                        })
                        ->orWhere('nis_peserta', 'like', "%$request->cari%");
                    })
                    ->latest()
                    ->paginate(10);

        return view('dashboard.peserta.data', compact('data_peserta'));
    }

    public function peserta_riwayat_pembayaran() {

        $data_transaksi = Transaksi::where('user_id',auth()->user()->id)->latest()->paginate(10);

        return view('dashboard.peserta.riwayat-pembayaran', compact('data_transaksi'));
    }

}
