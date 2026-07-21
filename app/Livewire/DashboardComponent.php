<?php

namespace App\Livewire;

use App\Models\Upload;
use App\Models\UploadDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class DashboardComponent extends Component
{
    use WithFileUploads;

    // ==========================
    // Dashboard
    // ==========================

    public $totalUpload = 0;
    public $successUpload = 0;
    public $failedUpload = 0;
    public $todayUpload = 0;

    public $uploads = [];

    // ==========================
    // Upload
    // ==========================

    public $file;

    protected $rules = [
    'file' => 'required|mimes:xlsx,xls|max:20480',
];

    public function mount()
    {
        $this->loadDashboard();
    }

    // public function updatedFile()
    // {
    //     dd($this->file);
    // }

    public function loadDashboard()
    {
        $this->totalUpload = Upload::count();

        $this->successUpload = Upload::where('status', 'Processed')->count();

        $this->failedUpload = Upload::where('status', 'Failed')->count();

        $this->todayUpload = Upload::whereDate('created_at', today())->count();

        $this->uploads = Upload::latest()->take(5)->get();
    }

    public function processUpload()
    {
        //  dd('1. Masuk processUpload');
        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:20480'
        ]);
        // dd('2. Lolos validasi');

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Simpan File
            |--------------------------------------------------------------------------
            */

            $originalName = $this->file->getClientOriginalName();

            $filename = time() . '_' . $originalName;

            $path = $this->file->storeAs(
                'uploads',
                $filename,
                'public'
            );
            // dd($path);

            /*
            |--------------------------------------------------------------------------
            | Simpan Metadata Upload
            |--------------------------------------------------------------------------
            */

            $upload = Upload::create([
                

                'user_iduser' => auth()->user()->iduser,

                'nama_file' => pathinfo($originalName, PATHINFO_FILENAME),

                'nama_asli' => $originalName,

                'file_path' => $path,

                'total_data' => 0,

                'status' => 'Uploaded',

                'generated_file' => null,

            ]);
            // dd($upload);
            $sheets = Excel::toArray([], $this->file);

            /*
            |--------------------------------------------------------------------------
            | Membaca Excel
            |--------------------------------------------------------------------------
            */

            // $sheets = Excel::toArray([], storage_path('app/public/' . $path));
            $sheets = Excel::toArray([], $this->file);
            // dd($sheets);
            $jumlahData = 0;

            foreach ($sheets as $sheetIndex => $sheet) {

                foreach ($sheet as $rowIndex => $row) {

                    UploadDetail::create([

                        'upload_idupload' => $upload->idupload,

                        'sheet_name' => 'Sheet ' . ($sheetIndex + 1),

                        'row_index' => $rowIndex + 1,

                        'row_data' => json_encode($row),

                    ]);

                    $jumlahData++;
                }

            }

            /*
            |--------------------------------------------------------------------------
            | Update Upload
            |--------------------------------------------------------------------------
            */

            $upload->update([

                'total_data' => $jumlahData,
                'status' => 'Processed'
            ]);

            DB::commit();

            $this->reset('file');

            $this->loadDashboard();

            session()->flash(
                'success',
                'File berhasil diproses.'
            );

        } catch (\Exception $e) {

            DB::rollBack();
            dd($e);
            session()->flash(
                'error',
                $e->getMessage()
            );
        }
    }
    public function updatedFile()
    {
        $this->validateOnly('file');
    }   

    public function delete($id)
    {
        $upload = Upload::find($id);

        if (!$upload) {
            return;
        }

        UploadDetail::where(
            'upload_idupload',
            $upload->idupload
        )->delete();

        if (
            file_exists(
                storage_path('app/public/' . $upload->file_path)
            )
        ) {
            unlink(
                storage_path('app/public/' . $upload->file_path)
            );
        }

        $upload->delete();

        $this->loadDashboard();

        session()->flash(
            'success',
            'File berhasil dihapus.'
        );
    }

    public function render()
    {
        return view('livewire.dashboard-component')
            ->layout('layouts.app');
    }
}