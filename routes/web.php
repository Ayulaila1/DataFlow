<?php

use App\Livewire\Auth\LoginComponent;
use App\Livewire\DashboardComponent;
use App\Livewire\DataFlow\DataFlowComponent;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', LoginComponent::class)->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardComponent::class)->name('dashboard');
});

// Route::get('/data-flow', DataFlowComponent::class)
//     ->name('data-flow');