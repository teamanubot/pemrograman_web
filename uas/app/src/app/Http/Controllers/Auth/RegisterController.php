<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Akun;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:akuns,email',
            'whatsapp_number' => 'required|string|max:20|unique:akuns,whatsapp_number',
            'password' => 'required|string|min:6|confirmed',
            'otp_input' => 'required|numeric',
        ]);

        $savedOtp = Session::get('otp_code');
        $otpExpired = Session::get('otp_expired');
        $otpUsed = Session::get('otp_used', false);

        if (!$savedOtp || !$otpExpired) {
            return back()->withErrors(['otp_input' => 'OTP tidak tersedia. Silakan kirim ulang.'])->withInput();
        }

        if (now()->greaterThan($otpExpired)) {
            return back()->withErrors(['otp_input' => 'OTP telah kadaluwarsa.'])->withInput();
        }

        if ($otpUsed) {
            return back()->withErrors(['otp_input' => 'OTP sudah digunakan.'])->withInput();
        }

        if ($request->otp_input != $savedOtp) {
            return back()->withErrors(['otp_input' => 'Kode OTP salah.'])->withInput();
        }

        // OTP valid
        $akun = Akun::create([
            'name' => $request->name,
            'email' => $request->email,
            'whatsapp_number' => $request->whatsapp_number,
            'password' => Hash::make($request->password),
        ]);

        Session::put('otp_used', true); // Tandai OTP sudah digunakan

        Auth::guard('akun')->login($akun);

        // Opsional: hapus semua data OTP dari session
        Session::forget(['otp_code', 'otp_expired', 'otp_used']);

        return redirect()->route('home')->with('success', 'Berhasil mendaftar!');
    }
}