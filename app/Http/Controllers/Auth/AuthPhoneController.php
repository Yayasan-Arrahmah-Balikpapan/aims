<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\NotificationService;
use App\Repositories\Interface\UserRepoInterface;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthPhoneRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Traits\TempPesanNotifTrait;
use App\Traits\ToastTrait;
use App\Exceptions\DataException;
use Illuminate\Support\Facades\Session;




class AuthPhoneController extends Controller
{
    use TempPesanNotifTrait;
    use ToastTrait;
    private $notifService;
    private $userRepo;
    public function __construct(UserRepoInterface $userRepo, NotificationService $notifService)
    {
        $this->userRepo = $userRepo;
        $this->notifService = $notifService;
    }
    public function akses()
    {
        return view('auth.phone.akses');
    }

    public function akses_validasi(Request $request)
    {
        $data = $request->validate([
            'phone_number' => ['required', 'min:9', 'max:14', new PhoneNumber],
            'phone_code'   => ['max:6', 'nullab-le'],
        ]);
        if (User::where('phone_number', $request->phone_number)->doesntExist()) {
            $user = $this->userRepo->storeDataValidasi($data);
            event(new Registered($user));
        }
        $nomor = $request->phone_number;
        // Logic
        $kode = rand(1000,9999);
        $user = $this->userRepo->findDataPhone($nomor);
        $this->userRepo->updateOTP($nomor, $kode);
        $this->notifService->kirimNotifWa($user->phone_code.ltrim($user->phone_number, '0'), $this->formatPesanAksesWa($kode));
        $this->successSendOTP($nomor);

        return redirect()->route('akses.nomor',
            ['nomor' => $request->phone_number,
                        // 'kode' => $kode
                    ]);
    }

    public function akses_nomor($nomor)
    {
        $user = $this->userRepo->findDataPhone($nomor);
        return view('auth.phone.kode', compact('nomor', 'user'));
    }

    public function akses_nomor_kirim_otp($nomor)
    {
        // Logic
        $kode = rand(1000,9999);
        $user = $this->userRepo->findDataPhone($nomor);
        $this->userRepo->updateOTP($nomor, $kode);
        $this->notifService->kirimNotifWa($user->phone_code.ltrim($user->phone_number, '0'), $this->formatPesanAksesWa($kode));
        $this->successSendOTP($nomor);

        return response()->json([
            'status'  => 'success',
            'message' => 'OTP sent successfully',
        ]);
    }

    public function akses_nomor_kirim_otp_sesi_waktu_mulai($nomor)
    {
        // Get current time
        $currentTime = Carbon::now()->timestamp;

        // Set session
        Session::put($nomor.'startTime', $currentTime);
        Session::put($nomor.'remainingTime', 60);

        return response()->json([
            'startTime'     => Session::get($nomor.'startTime'),
            'remainingTime' => Session::get($nomor.'remainingTime')
        ]);
    }

    public function akses_nomor_kirim_otp_sesi_waktu_batas($nomor)
    {
        // Get remaining time from session
        $startTime = Session::get($nomor.'startTime', 0);
        $remainingTime = Session::get($nomor.'remainingTime', 0);

        // Calculate remaining time
        $elapsedTime = time() - $startTime;
        $remainingTime = max(0, $remainingTime - $elapsedTime);

        return response()->json(['remainingTime' => $remainingTime]);
    }

    public function akses_login(AuthPhoneRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
