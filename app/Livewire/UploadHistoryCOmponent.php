<?php

namespace App\Livewire;

use App\Models\Upload;
use Livewire\Component;
use Livewire\WithPagination;

class UploadHistoryComponent extends Component
{
    use WithPagination;

    public $search = '';

    public $status = '';

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $upload = Upload::find($id);

        if (!$upload) {
            return;
        }

        if ($upload->file_path && file_exists(storage_path('app/public/' . $upload->file_path))) {
            unlink(storage_path('app/public/' . $upload->file_path));
        }

        $upload->delete();

        session()->flash(
            'success',
            'Data berhasil dihapus.'
        );
    }

    public function render()
    {
        $uploads = Upload::query()

            ->when($this->search, function ($q) {

                $q->where('nama_asli', 'like', '%' . $this->search . '%');

            })

            ->when($this->status, function ($q) {

                $q->where('status', $this->status);

            })

            ->latest()

            ->paginate(10);

        return view('livewire.upload-history-component', [
            'uploads' => $uploads
        ])->layout('layouts.app');
    }
    public function detail($id)
{
    return redirect()->route('history.detail', $id);
}
}