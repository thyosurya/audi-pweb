<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::with('cucian')->latest()->get();
        return view('pesanan.index', compact('pesanan'));
    }

    public function create()
    {
        return view('pesanan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'no_hp' => 'required|string|max:15',
            'jenis_cucian' => 'required|string|max:50',
            'berat' => 'required|numeric|min:0.1',
            'tanggal_masuk' => 'required|date',
        ]);

        Pesanan::create($validated);
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil ditambahkan');
    }

    public function show($id)
    {
        $pesanan = Pesanan::with(['cucian.penyimpanan'])->findOrFail($id);
        return view('pesanan.show', compact('pesanan'));
    }

    public function edit($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('pesanan.edit', compact('pesanan'));
    }

    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'no_hp' => 'required|string|max:15',
            'jenis_cucian' => 'required|string|max:50',
            'berat' => 'required|numeric|min:0.1',
            'tanggal_masuk' => 'required|date',
        ]);

        $pesanan->update($validated);
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diupdate');
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();
        return redirect()->route('pesanan.index')->with('success', 'Pesanan deleted successfully');
    }
}
