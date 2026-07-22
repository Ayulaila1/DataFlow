<?php

use App\Livewire\Auth\LoginComponent;
use App\Livewire\DashboardComponent;
use App\Livewire\ExcelEditor;
use App\Livewire\UploadHistoryComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

Route::middleware('guest')->group(function () {
    Route::get('/', LoginComponent::class)->name('login');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', DashboardComponent::class)
        ->name('dashboard');

    Route::get('/history-upload', UploadHistoryComponent::class)
        ->name('history.index');

    Route::get('/history-upload/{id}', ExcelEditor::class)
        ->name('history.detail');

});