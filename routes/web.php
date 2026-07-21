<?php

use App\Livewire\Auth\LoginComponent;
use App\Livewire\DashboardComponent;
use App\Livewire\UploadHistoryComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Guest
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/', LoginComponent::class)
        ->name('login');
});

/*
|--------------------------------------------------------------------------
| Authenticated
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', DashboardComponent::class)
        ->name('dashboard');

    // Riwayat Upload
    Route::get('/history-upload', UploadHistoryComponent::class)
        ->name('history.index');

    // Jika nanti ada halaman detail, buat Livewire Component baru
    // Route::get('/history-upload/{id}', HistoryDetailComponent::class)
    //     ->name('history.detail');
});