<?php

namespace App\Imports;

use App\Models\Layanan;
use Maatwebsite\Excel\Concerns\ToModel;

class LayananImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
      public function model(array $row)
    {
        // Lewati baris header
        if ($row[0] === 'nama_layanan') {
            return null;
        }

        return new Layanan([
            'nama_layanan' => $row['0'],
            'deskripsi'    => $row['1'],
            'harga_satuan' => $row['2'],
        ]);
    }
}
