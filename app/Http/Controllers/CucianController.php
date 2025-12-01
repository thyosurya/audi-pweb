<?php

namespace App\Http\Controllers;

use App\Models\Cucian;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class CucianController extends Controller
{
    public function index()
    {
        $cucian = Cucian::with(['pesanan', 'penyimpanan'])->latest()->get();
        return view('cucian.index', compact('cucian'));
    }

    public function create()
    {
        $pesanan = Pesanan::all();
        return view('cucian.create', compact('pesanan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pesanan' => 'required|exists:pesanan,id_pesanan',
        ]);

        // Generate no_pesanan otomatis
        $lastCucian = Cucian::latest('id_cucian')->first();
        $nextNumber = $lastCucian ? $lastCucian->id_cucian + 1 : 1;
        $validated['no_pesanan'] = 'CUC-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        
        // Set status default ke Proses
        $validated['status_cucian'] = 'Proses';

        Cucian::create($validated);
        return redirect()->route('cucian.index')->with('success', 'Cucian created successfully');
    }

    public function show($id)
    {
        $cucian = Cucian::with(['pesanan', 'penyimpanan'])->findOrFail($id);
        return view('cucian.show', compact('cucian'));
    }

    public function edit($id)
    {
        $cucian = Cucian::findOrFail($id);
        
        // Cek apakah status sudah Selesai
        if ($cucian->status_cucian === 'Selesai') {
            return redirect()->route('cucian.index')->with('error', 'Cucian dengan status Selesai tidak dapat diedit!');
        }
        
        $pesanan = Pesanan::all();
        return view('cucian.edit', compact('cucian', 'pesanan'));
    }

    public function update(Request $request, $id)
    {
        $cucian = Cucian::findOrFail($id);
        
        // Cek apakah status sudah Selesai
        if ($cucian->status_cucian === 'Selesai') {
            return redirect()->route('cucian.index')->with('error', 'Cucian dengan status Selesai tidak dapat diedit!');
        }
        
        $validated = $request->validate([
            'id_pesanan' => 'required|exists:pesanan,id_pesanan',
            'status_cucian' => 'required|string|max:20',
        ]);

        // Cek apakah user mencoba mengubah status ke Selesai
        if ($validated['status_cucian'] === 'Selesai') {
            // Cek apakah cucian sudah masuk ke rak penyimpanan
            if (!$cucian->penyimpanan) {
                return redirect()->back()->withErrors(['status_cucian' => 'Cucian belum masuk ke rak penyimpanan! Tidak bisa diubah ke status Selesai.'])->withInput();
            }
        }

        $cucian->update($validated);
        return redirect()->route('cucian.index')->with('success', 'Cucian updated successfully');
    }

    public function destroy($id)
    {
        $cucian = Cucian::findOrFail($id);
        $cucian->delete();
        return redirect()->route('cucian.index')->with('success', 'Cucian deleted successfully');
    }
}
