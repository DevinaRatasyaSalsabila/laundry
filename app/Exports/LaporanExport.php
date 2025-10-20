<?php

namespace App\Exports;

use App\Models\Layanan;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    /**
     * Ambil semua data produk dari DB
     */
    public function collection()
    {
        return DB::table('tb_transaksi')
            ->join('tb_detailTransaksi', 'tb_transaksi.id_transaksi', '=', 'tb_detailTransaksi.id_transaksi')
            ->join('tb_layanan', 'tb_detailTransaksi.id_layanan', '=', 'tb_layanan.id_layanan')
            ->select(
                'tb_transaksi.tanggal',
                DB::raw('COUNT(DISTINCT tb_transaksi.id_transaksi) as jumlah_transaksi'),
                DB::raw('SUM(tb_layanan.harga_satuan * tb_detailTransaksi.berat) as total_pendapatan')
            )
            ->where('tb_transaksi.status', '=', 'Diambil')
            ->groupBy('tb_transaksi.tanggal')
            ->orderBy('tb_transaksi.tanggal', 'asc')
            ->get();
    }

    /**
     * Judul kolom di file Excel
     */
    public function headings(): array
    {
        return [
            'Tanggal',
            'Jumlah Transaksi',
            'Total Pendapatan'
        ];
    }
}
