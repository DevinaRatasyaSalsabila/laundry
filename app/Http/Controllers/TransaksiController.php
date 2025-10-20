<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiDetailExport;
use App\Exports\TransaksiExport;
use App\Imports\TransaksiImport;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
            // ->where('tb_transaksi.status', '=', 'Belum Diambil')
            ->groupBy('tb_transaksi.id_transaksi', 'tb_transaksi.status', 'tb_transaksi.nama_pelanggan',)
            ->get();

        $detail = DB::table('tb_transaksi')
            ->join('tb_detailTransaksi', 'tb_transaksi.id_transaksi', '=', 'tb_detailTransaksi.id_transaksi')
            ->join('tb_layanan', 'tb_detailTransaksi.id_layanan', '=', 'tb_layanan.id_layanan')
            ->select(
                'tb_transaksi.id_transaksi',
                'tb_layanan.nama_layanan',
                'tb_layanan.harga_satuan',
                'tb_detailTransaksi.berat'
            )
            ->orderBy('tb_transaksi.id_transaksi')
            // ->where('tb_transaksi.status', '=', 'Belum Diambil')
            ->get()
            ->groupBy('id_transaksi');

        $layanan = DB::table('tb_layanan')->get();

        return view('transaksi.index', compact('transaksi', 'layanan', 'detail'));
    }

    public function store(Request $request)
    {
        // $transaksi = Transaksi::create([
        //     'tanggal' => $request->tanggal,
        //     // 'id_layanan' => $request->id_layanan,
        //     // 'berat' => $request->berat,
        //     'nama_pelanggan' => $request->nama_pelanggan,
        //     'status' => $request->status,
        // ]);


        $idTransaksi = DB::table('tb_transaksi')->insertGetId([
            'tanggal' => $request->tanggal,
            'nama_pelanggan' => $request->nama_pelanggan,
            'status' => $request->status,
        ]);

        foreach ($request->layanan as $item) {
            DB::table('tb_detailTransaksi')->insert([
                'id_transaksi' => $idTransaksi,
                'id_layanan'   => $item['id_layanan'],
                'berat'        => $item['berat'],
            ]);
        }

        return redirect()
            ->route('transaksi')
            ->with('success', 'Data Transaksi Berhasil Ditambahkan');
    }
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'tanggal' => $request->tanggal,
            'nama_pelanggan' => $request->nama_pelanggan,
            'status' => $request->status,
        ]);

        // Hapus detail lama
        DB::table('tb_detailTransaksi')->where('id_transaksi', $id)->delete();

        // Simpan detail baru
        foreach ($request->layanan as $item) {
            DB::table('tb_detailTransaksi')->insert([
                'id_transaksi' => $id,
                'id_layanan'  => $item['id_layanan'],
                'berat'       => $item['berat'],
            ]);
        }
        return redirect()->route('transaksi')->with('success', 'Data Transaksi Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        TransaksiDetail::where('id_transaksi', $id)->delete();
        Transaksi::findOrFail($id)->delete();
        return redirect()
            ->route('transaksi')
            ->with('success', 'Data Transaksi Berhasil Dihapus');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new TransaksiImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data layanan berhasil diimport!');
    }
    public function exportExcel()
    {
        // Nama file: produk.xlsx
        return Excel::download(new TransaksiDetailExport(), 'DataTransaksi.xlsx');
    }
    public function cetak($id)
    {
        $transaksi = DB::table('tb_transaksi')
            ->where('tb_transaksi.id_transaksi', $id)
            ->first();

        $detail = DB::table('tb_detailTransaksi')
            ->join('tb_layanan', 'tb_detailTransaksi.id_layanan', '=', 'tb_layanan.id_layanan')
            ->where('tb_detailTransaksi.id_transaksi', $id)
            ->select(
                'tb_layanan.nama_layanan',
                'tb_detailTransaksi.berat',
                'tb_layanan.harga_satuan',
                DB::raw('(tb_detailTransaksi.berat * tb_layanan.harga_satuan) as subtotal')
            )
            ->get();

        $total = $detail->sum('subtotal');

        return view('transaksi.struk', compact('transaksi', 'detail', 'total'));
    }
}
