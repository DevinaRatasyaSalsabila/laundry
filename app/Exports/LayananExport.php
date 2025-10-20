<?php

namespace App\Exports;

use App\Models\Layanan;
use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LayananExport implements FromCollection, WithHeadings
{
    /**
     * Ambil semua data produk dari DB
     */
    public function collection()
    {
        // ambil kolom yang ingin diexport, contoh: id, nama, harga, stok
        return Layanan::select('id_layanan', 'nama_layanan', 'deskripsi', 'harga_satuan')->get();
    }

    /**
     * Judul kolom di file Excel
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Layanan',
            'Deskripsi',
            'Harga Satuan'
        ];
    }
}
