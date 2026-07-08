<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DashboardComponent extends Component
{
    public $totalUpload = 0;

    public $successUpload = 0;

    public $failedUpload = 0;

    public $todayUpload = 0;

    public $uploads = [];

    public function mount()
    {
        $this->loadDashboard();
    }

    public function loadDashboard()
    {
        $this->totalUpload = DB::table('uploads')->count();

        $this->successUpload = DB::table('uploads')
            ->where('status', 'Processed')
            ->count();

        $this->failedUpload = DB::table('uploads')
            ->where('status', 'Failed')
            ->count();

        $this->todayUpload = DB::table('uploads')
            ->whereDate('created_at', today())
            ->count();

        $this->uploads = DB::table('uploads')
            ->latest()
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard-component')
            ->layout('layouts.app');
    }
}