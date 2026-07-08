<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataFlowImport;

class DashboardComponent extends Component
{
    use WithFileUploads;

    public $totalUpload = 0;

    public $successUpload = 0;

    public $failedUpload = 0;

    public $todayUpload = 0;
    public $file;
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

    public function upload()
    {
        $this->validate([

            'file' => 'required|mimes:xlsx,xls|max:10240'

        ]);

        $import = new DataFlowImport();

        Excel::import($import, $this->file);

        dd($import->rows);
    }

    public function render()
    {
        return view('livewire.dashboard-component')
            ->layout('layouts.app');
    }
}