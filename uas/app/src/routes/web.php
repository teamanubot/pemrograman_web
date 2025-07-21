<?php

use App\Livewire\CekStatus;
use App\Livewire\Daftar;
use App\Livewire\ShowHomePage;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Livewire\Akun\AkunLogin;
use App\Livewire\ProductPage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OtpController;


/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/
Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
Route::get('/', ShowHomePage::class )->name('home');
Route::get('/daftar', \App\Livewire\Daftar::class)->name('daftar');
Route::get('/order', ProductPage::class )->name('order');
Route::get('/cek-status', CekStatus::class )->name('cek-status');
Route::get('/login', AkunLogin::class)->name('akun.login');
Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('send.otp');  
Route::get('/invoice/{id}', [InvoiceController::class, 'download'])->name('invoice.download');

Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showForm'])->name('akun.register');

// Submit register
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('akun.register.submit');

// Kirim OTP
Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('send.otp');


Route::get('/tes-otp', function () {
    $res = Http::withHeaders([
        'x-whatsapp-token' => 'rivai123',
    ])->post('http://152.42.185.116:3000/send', [
        'number' => '6281234567890',
        'message' => 'Test OTP dari route manual',
    ]);

    return $res->body();
});

Route::post('/logout-akun', function () {
    Auth::guard('akun')->logout();
    return redirect('/');
})->name('akun.logout');

Route::middleware('auth:akun')->group(function () {
    Route::get('/profil', function () {
        return view('/'); // contoh halaman setelah login
    })->name('akun.profil');
});