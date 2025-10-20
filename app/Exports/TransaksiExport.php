<?php

namespace App\Exports;

use App\Models\Layanan;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiExport implements FromCollection, WithHeadings
{
    /**
     * Ambil semua data produk dari DB
     */
    public function collection()
    {
        //     // ambil kolom yang ingin diexport, contoh: id, nama, harga, stok
        //     return Transaksi::select('id_transaksi','nama_pelanggan', 'tanggal', 'status')->get();
        return DB::table('tb_transaksi')
            ->join('tb_detailTransaksi', 'tb_transaksi.id_transaksi', '=', 'tb_detailTransaksi.id_transaksi')
            ->join('tb_layanan', 'tb_detailTransaksi.id_layanan', '=', 'tb_layanan.id_layanan')
            ->select(
                'tb_transaksi.id_transaksi',
                'tb_transaksi.nama_pelanggan',
                'tb_transaksi.tanggal',
                'tb_transaksi.status',
                DB::raw('SUM(tb_layanan.harga_satuan * tb_detailTransaksi.berat) as total')
            )
            // ->where('tb_transaksi.status', '=', 'Belum Diambil')
            ->groupBy('tb_transaksi.id_transaksi', 'tb_transaksi.status', 'tb_transaksi.nama_pelanggan',)
            ->get();
    }

    /**
     * Judul kolom di file Excel
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Pelanggan',
            'Tanggal',
            'Status',
            'Total',
        ];
    }
}
