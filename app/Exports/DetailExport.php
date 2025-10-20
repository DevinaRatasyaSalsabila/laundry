<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DetailExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DB::table('tb_transaksi')
            ->join('tb_detailTransaksi', 'tb_transaksi.id_transaksi', '=', 'tb_detailTransaksi.id_transaksi')
            ->join('tb_layanan', 'tb_detailTransaksi.id_layanan', '=', 'tb_layanan.id_layanan')
            ->select(
                'tb_transaksi.id_transaksi',
                'tb_layanan.nama_layanan',
                'tb_layanan.harga_satuan',
                'tb_detailTransaksi.berat',
                DB::raw('(tb_layanan.harga_satuan * tb_detailTransaksi.berat) as total')
            )
            // ->where('tb_transaksi.status', '=', 'Belum Diambil')
            ->orderBy('tb_transaksi.id_transaksi')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Nama Layanan',
            'Harga Satuan',
            'Berat',
            'Total (Harga × Berat)',
        ];
    }
}
