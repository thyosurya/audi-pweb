<?php

namespace App\Http\Controllers;

use App\Models\Penyimpanan;
use App\Models\Cucian;
use Illuminate\Http\Request;

class PenyimpananController extends Controller
{
    public function index()
    {
        $penyimpanan = Penyimpanan::with(['cucian.pesanan'])->latest()->get();
        return view('penyimpanan.index', compact('penyimpanan'));
    }

    public function create()
    {
        $cucian = Cucian::all();
        $occupiedRacks = Penyimpanan::pluck('lokasi_rak')->toArray();
        return view('penyimpanan.create', compact('cucian', 'occupiedRacks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_cucian' => 'required|exists:cucian,id_cucian',
            'tanggal_simpan' => 'required|date',
            'lokasi_rak' => 'required|string|max:20|unique:penyimpanan,lokasi_rak',
        ], [
            'lokasi_rak.unique' => 'Rak ini sudah terisi, silakan pilih rak lain.'
        ]);

        Penyimpanan::create($validated);
        return redirect()->route('penyimpanan.index')->with('success', 'Penyimpanan created successfully');
    }

    public function show($id)
    {
        $penyimpanan = Penyimpanan::with(['cucian.pesanan'])->findOrFail($id);
        return view('penyimpanan.show', compact('penyimpanan'));
    }

    public function edit($id)
    {
        $penyimpanan = Penyimpanan::findOrFail($id);
        $cucian = Cucian::all();
        $occupiedRacks = Penyimpanan::where('id_penyimpanan', '!=', $id)
            ->pluck('lokasi_rak')
            ->toArray();
        return view('penyimpanan.edit', compact('penyimpanan', 'cucian', 'occupiedRacks'));
    }

    public function update(Request $request, $id)
    {
        $penyimpanan = Penyimpanan::findOrFail($id);
        
        $validated = $request->validate([
            'id_cucian' => 'required|exists:cucian,id_cucian',
            'tanggal_simpan' => 'required|date',
            'lokasi_rak' => 'required|string|max:20|unique:penyimpanan,lokasi_rak,' . $id . ',id_penyimpanan',
        ], [
            'lokasi_rak.unique' => 'Rak ini sudah terisi, silakan pilih rak lain.'
        ]);

        $penyimpanan->update($validated);
        return redirect()->route('penyimpanan.index')->with('success', 'Penyimpanan updated successfully');
    }

    public function destroy($id)
    {
        $penyimpanan = Penyimpanan::findOrFail($id);
        $penyimpanan->delete();
        return redirect()->route('penyimpanan.index')->with('success', 'Penyimpanan deleted successfully');
    }
}
