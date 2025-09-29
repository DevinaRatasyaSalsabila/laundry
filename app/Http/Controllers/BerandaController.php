<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index()
    {
        $transaksi = DB::table('tb_transaksi')
            ->join('tb_detailTransaksi', 'tb_transaksi.id_transaksi', '=', 'tb_detailTransaksi.id_transaksi')
            ->join('tb_layanan', 'tb_detailTransaksi.id_layanan', '=', 'tb_layanan.id_layanan')
            ->select(
                'tb_transaksi.id_transaksi',
                'tb_transaksi.status',
                'tb_transaksi.nama_pelanggan',
                'tb_transaksi.tanggal',
                DB::raw('SUM(tb_layanan.harga_satuan * tb_detailTransaksi.berat) as total')
            )
            ->orderBy('tb_transaksi.created_at', 'desc')
            ->groupBy('tb_transaksi.id_transaksi', 'tb_transaksi.status', 'tb_transaksi.nama_pelanggan',)
            ->take(5)
            ->get();

        $jumlahLayanan = DB::table('tb_layanan')->count();
        $jumlahTransaksi = DB::table('tb_transaksi')->count();
        $belumDiambil = DB::table('tb_transaksi')
            ->where('tb_transaksi.status', '=', 'Belum Diambil')
            ->count();
        // $pendapatanHariIni = DB::table('tb_transaksi')
        //     ->join('tb_layanan', 'tb_transaksi.id_layanan', '=', 'tb_layanan.id_layanan')
        //     ->whereDate('tb_transaksi.tanggal', Carbon::today())
        //     ->select(DB::raw('SUM(tb_transaksi.berat * tb_layanan.harga_satuan) as total_pendapatan'))
        //     ->value('total_pendapatan');

        return view(
            'beranda.index',
            compact('transaksi', 'jumlahLayanan', 'jumlahTransaksi', 'belumDiambil')
        );
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
