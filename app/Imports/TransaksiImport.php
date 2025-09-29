<?php

namespace App\Imports;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Layanan;
use App\Models\TransaksiDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TransaksiImport implements ToModel, WithHeadingRow
{
    private $cacheTransaksi = [];

    public function model(array $row)
    {
        // Ambil data berdasarkan nama kolom di Excel
        $status         = $row['status'];
        $nama_pelanggan = $row['nama_pelanggan'];
        $tanggal        = $row['tanggal'];
        $berat          = $row['berat'];
        $nama_layanan   = $row['nama_layanan'];

        // Key unik berdasarkan nama + tanggal
        $key = $nama_pelanggan . '|' . $tanggal;

        if (!isset($this->cacheTransaksi[$key])) {
            // Buat transaksi baru
            $transaksi = Transaksi::create([
                'status'         => $status,
                'nama_pelanggan' => $nama_pelanggan,
                'tanggal'        => $tanggal,
            ]);

            $this->cacheTransaksi[$key] = $transaksi->id;
        }

        // Cari id_layanan berdasarkan nama_layanan
        $layanan = Layanan::where('nama_layanan', $nama_layanan)->first();

        if ($layanan) {
            TransaksiDetail::create([
                'id_transaksi' => $this->cacheTransaksi[$key],
                'berat'        => $berat,
                'id_layanan'   => $layanan->id,
            ]);
        }

        return null; // ToModel butuh return, tapi null juga boleh
    }
}
