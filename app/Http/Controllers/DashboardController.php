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

        $data_peserta = Peserta::where('user_id',auth()->user()->id)->paginate(10);

        $api_token = $user->createToken('api-token')->plainTextToken;

        // dd($api_token);

        return view('dashboard', compact('user', 'data_peserta', 'api_token'));
    }

    public function peserta($uuid) {

        $peserta = Peserta::where('uuid', $uuid)->first();

        if (!$peserta) { abort(404); }

        $user = auth()->user();
        $roles = $this->roleRepo->getData();
        $user  = $this->userRepo->findData($user->id);

        return view('dashboard.peserta.peserta', compact('user', 'peserta', 'uuid'));
    }

    public function peserta_data() {

        $data_peserta = Peserta::where('user_id',auth()->user()->id)->paginate(10);

        $user = auth()->user();
        $roles = $this->roleRepo->getData();
        $user  = $this->userRepo->findData($user->id);

        return view('dashboard.peserta.data', compact('user', 'data_peserta'));
    }

    public function peserta_riwayat_pembayaran() {

        $data_peserta = Peserta::where('user_id',auth()->user()->id)->paginate(10);
        $data_transaksi = Transaksi::where('user_id',auth()->user()->id)->paginate(10);

        $user = auth()->user();
        $roles = $this->roleRepo->getData();
        $user  = $this->userRepo->findData($user->id);

        return view('dashboard.peserta.riwayat-pembayaran', compact('user', 'data_peserta', 'data_transaksi'));
    }


}
