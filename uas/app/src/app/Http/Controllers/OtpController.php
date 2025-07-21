<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class OtpController extends Controller
{
    // Di App\Http\Controllers\OtpController
    public function sendOtp(Request $request)
    {
        $request->validate([
            'whatsapp_number' => 'required|max:20'
        ]);

        // Normalisasi nomor
        $phone = preg_replace('/\D/', '', $request->whatsapp_number);
        if (Str::startsWith($phone, '+62')) {
            $normalizedPhone = '62' . $phone;
        } elseif (Str::startsWith($phone, '08')) {
            $normalizedPhone = '62' . substr($phone, 1);
        } elseif (Str::startsWith($phone, '62')) {
            $normalizedPhone = $phone;
        } else {
            return response()->json(['message' => 'Format nomor tidak valid'], 422);
        }

        // Cek apakah masih dalam periode tunggu 5 menit
        if (Session::has('otp_expired') && now()->lessThan(Session::get('otp_expired'))) {
            return response()->json(['message' => 'OTP sudah dikirim. Tunggu 5 menit sebelum mengirim ulang.'], 429);
        }

        // Generate dan simpan OTP
        $otp = rand(100000, 999999);
        Session::put('otp_code', $otp);
        Session::put('otp_expired', now()->addMinutes(5));
        Session::put('otp_used', false);

        try {
            $response = Http::withHeaders([
                config('services.whatsapp_api_key_header', 'x-whatsapp-token') => config('services.whatsapp_api_key'),
            ])->post(config('services.whatsapp_api_url'), [
                'number' => $normalizedPhone,
                'message' => "Kode verifikasi OTP Anda adalah: {$otp}. Berlaku selama 5 menit.",
            ]);     

            if ($response->failed()) {
                return response()->json(['message' => 'Gagal kirim OTP'], 500);
            }

            return response()->json(['message' => 'OTP terkirim']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal: ' . $e->getMessage()], 500);
        }
    }
}