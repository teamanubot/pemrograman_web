<?php

use App\Livewire\CekStatus;
use App\Livewire\Daftar;
use App\Livewire\ShowHomePage;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

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
Route::get('/daftar', Daftar::class )->name('daftar');
Route::get('/cek-status', CekStatus::class )->name('cek-status');