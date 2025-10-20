<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TransaksiDetailExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Transaksi' => new TransaksiExport(),
            'Detail Transaksi' => new DetailExport(),
        ];
    }
}
