<?php

namespace App\Imports;

use App\Imports\SheetImport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DataFlowImport implements WithMultipleSheets
{
    public $sheets = [];

    public function sheets(): array
    {
        return [
            new SheetImport($this)
        ];
    }
}