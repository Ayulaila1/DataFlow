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

    public function mount()
    {
        $this->loadDashboard();
    }

    public function loadDashboard()
    {
        $this->totalUpload = Upload::count();

        $this->successUpload = Upload::where('status', 'Processed')->count();

        $this->failedUpload = Upload::where('status', 'Failed')->count();

        $this->todayUpload = Upload::whereDate('created_at', today())->count();

        $this->uploads = Upload::latest()->take(5)->get();
    }

    public function upload()
    {
        dd('MASUK METHOD UPLOAD');
        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:20480'
        ]);

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

            /*
            |--------------------------------------------------------------------------
            | Simpan Metadata Upload
            |--------------------------------------------------------------------------
            */

            $upload = Upload::create([

                'user_iduser' => session('iduser'),

                'nama_file' => pathinfo($originalName, PATHINFO_FILENAME),

                'nama_asli' => $originalName,

                'file_path' => $path,

                'total_data' => 0,

                'status' => 'Uploaded',

                'generated_file' => null,

            ]);

            /*
            |--------------------------------------------------------------------------
            | Membaca Excel
            |--------------------------------------------------------------------------
            */

            $sheets = Excel::toArray([], storage_path('app/public/' . $path));

            $jumlahData = 0;

            foreach ($sheets as $sheetIndex => $sheet) {

                foreach ($sheet as $rowIndex => $row) {

                    UploadDetail::create([

                        'upload_idupload' => $upload->idupload,

                        'sheet_name' => 'Sheet ' . ($sheetIndex + 1),

                        'row_index' => $rowIndex + 1,

                        'row_data' => $row,

                        'status' => 'Valid',

                        'notes' => null,

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

            session()->flash(
                'error',
                $e->getMessage()
            );
        }
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