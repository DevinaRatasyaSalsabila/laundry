<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = DB::table('tb_transaksi')
            ->join('tb_layanan', 'tb_layanan.id_layanan', '=', 'tb_transaksi.id_layanan')
            ->select('tb_layanan.*')
            ->select('tb_transaksi.*')
            ->get();
        $layanan = DB::table('tb_layanan')->get();

        return view('transaksi.index', compact('transaksi', 'layanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Transaksi::create([
            'tanggal' => $request->tanggal,
            'id_layanan' => $request->id_layanan,
            'berat' => $request->berat,
            'nama_pelanggan' => $request->nama_pelanggan,
        ]);

        return redirect()
            ->route('transaksi')
            ->with('success', 'Data Transaksi Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->update([
            'tanggal' => $request->tanggal,
            'id_layanan' => $request->id_layanan,
            'berat' => $request->berat,
            'nama_pelanggan' => $request->nama_pelanggan,
        ]);

        return redirect()->route('transaksi')->with('success', 'Data Transaksi Berhasil DiRubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id)->delete();
        return redirect()->route('transaksi')->with('success', 'Data Transaksi Berhasil Dihapus');
    }
}
