<?php

namespace App\Livewire;

use App\Models\Upload;
use Livewire\Component;
use Livewire\Attributes\Layout;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelEditor extends Component
{
    public $uploadId;
    public $upload;
    public $celData = [];

    public function mount($id)
    {
        $this->uploadId = $id;

        $this->upload = Upload::findOrFail($id);

        $filePath = storage_path('app/public/' . $this->upload->file_path);

        if (file_exists($filePath)) {

            $spreadsheet = IOFactory::load($filePath);

            $sheet = $spreadsheet->getActiveSheet();

            $dataArray = $sheet->toArray(null, true, true, true);

            $r = 0;

            foreach ($dataArray as $row) {

                $c = 0;

                foreach ($row as $cellValue) {

                    if ($cellValue !== null) {

                        $this->celData[] = [
                            'r' => $r,
                            'c' => $c,
                            'v' => [
                                'v' => $cellValue,
                                'm' => (string) $cellValue,
                            ],
                        ];

                    }

                    $c++;
                }

                $r++;
            }
        }
    }

    public function saveExcel($jsonData)
    {
        $excelData = json_decode($jsonData, true);

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        if (is_array($excelData)) {

            foreach ($excelData as $cell) {

                $row = $cell['r'] + 1;

                $col = $cell['c'] + 1;

                $value = $cell['v']['v'] ?? ($cell['v'] ?? '');

                $sheet->setCellValueByColumnAndRow($col, $row, $value);
            }
        }

        $writer = new Xlsx($spreadsheet);

        $writer->save(storage_path('app/public/' . $this->upload->file_path));

        session()->flash('success', 'Data Excel berhasil diperbarui.');
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.excel-editor');
    }
}