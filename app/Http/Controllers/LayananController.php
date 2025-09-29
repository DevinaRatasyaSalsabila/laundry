<?php

namespace App\Http\Controllers;

use App\Imports\LayananImport;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = Layanan::ALL();
        return view('layanan.index', compact('layanan'));
    }


    public function create() {}

    public function store(Request $request)
    {

        Layanan::create([
            'nama_layanan' => $request->nama_layanan,
            'harga_satuan' => $request->harga_satuan,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('layanan')
            ->with('success', 'Layanan Berhasil Ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id_layanan)
    {
        $layanan = Layanan::find($id_layanan);
        $layanan->update([
            'nama_layanan' => $request->nama_layanan,
            'harga_satuan' => $request->harga_satuan,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('layanan')
            ->with('success', 'Data Layanan Berhasil Diperbarui');
    }

    public function destroy(string $id)
    {
        $layanan = Layanan::findOrFail($id)->delete();
        return redirect()
            ->route('layanan')
            ->with('success', 'Data Layanan Berhasil Dihapus');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new LayananImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data layanan berhasil diimport!');
    }
}
