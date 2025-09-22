<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

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
        //
    }
}
