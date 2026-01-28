<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Rules\PhoneNumber;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function update_phone(Request $request, $id)
    {
        $request->validate([
            'phone_number' => ['required', 'min:8', 'max:15', new PhoneNumber, 'unique:'.User::class],
            'phone_code'   => ['max:6']
        ],[
            'phone_number.required' => 'Nomor handphone wajib diisi!',
            'phone_number.min' => 'Nomor handphone minimal 8 karakter!',
            'phone_number.max' => 'Nomor handphone maksimal 15 karakter!',
            'phone_number.unique' => 'Nomor handphone sudah  terdaftar!',
            'phone_code.max' => 'Kode telepon maksimal 6 karakter!',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'phone_code' => $request->phone_code,
            'phone_number' => $request->phone_number,
        ]);

        return Redirect::route('profile.edit')->with('status', 'phone-updated');
    }
}
