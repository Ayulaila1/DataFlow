<?php

namespace App\Livewire;

use App\Models\Upload;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Html;

class UploadDetailComponent extends Component
{
    public $upload;

    public $html = "";

    public function mount($id)
    {
        $this->upload = Upload::findOrFail($id);

        $path = storage_path(
            'app/public/' . $this->upload->file_path
        );

        $spreadsheet = IOFactory::load($path);

        $writer = new Html($spreadsheet);

        ob_start();

        $writer->save('php://output');

        $this->html = ob_get_clean();
    }

    public function render()
    {
        return view('livewire.upload-detail-component')
            ->layout('layouts.app');
    }
}