<?php

namespace App\Imports;

use App\Models\Transaksi;
use App\Models\Layanan;
use App\Models\TransaksiDetail;
use PhpOffice\PhpSpreadsheet\Shared\Date; 
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TransaksiImport implements ToModel, WithHeadingRow
{
    private $cacheTransaksi = [];

    public function model(array $row)
    {
        // Ambil data berdasarkan nama kolom di Excel
        $status         = $row['status'] ?? null;
        $nama_pelanggan = $row['nama_pelanggan'];
        $tanggal        = $row['tanggal'];
        $berat          = $row['berat'];
        $nama_layanan   = $row['nama_layanan'];

        // Jika kolom status kosong, isi default "Belum Diambil"
        if (empty($status)) {
            $status = 'Belum Diambil';
        }

        if (is_numeric($tanggal)) {
            $tanggal = Date::excelToDateTimeObject($tanggal)->format('Y-m-d');
        }

        // Buat key unik berdasarkan nama + tanggal
        $key = $nama_pelanggan . '|' . $tanggal;

        // Cek apakah transaksi dengan key ini sudah dibuat
        if (!isset($this->cacheTransaksi[$key])) {
            // Buat transaksi baru
            $transaksi = Transaksi::create([
                'status'         => $status,
                'nama_pelanggan' => $nama_pelanggan,
                'tanggal'        => $tanggal,
            ]);

            // Simpan ke cache supaya tidak duplikat
            $this->cacheTransaksi[$key] = $transaksi->id_transaksi;
        }

        // Cari id_layanan berdasarkan nama_layanan
        $layanan = Layanan::where('nama_layanan', $nama_layanan)->first();

        // Jika layanan ditemukan, buat detail transaksi
        if ($layanan) {
            TransaksiDetail::create([
                'id_transaksi' => $this->cacheTransaksi[$key],
                'berat'        => $berat,
                'id_layanan'   => $layanan->id_layanan,
            ]);
        }

        return null; // Tidak mengembalikan model karena sudah disimpan manual
    }
}
