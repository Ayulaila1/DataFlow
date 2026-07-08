<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\LoginComponent;

Route::get('/', LoginComponent::class)->name('login');