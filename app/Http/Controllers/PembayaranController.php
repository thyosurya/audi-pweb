<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Penyimpanan;
use App\Models\Pesanan;
use App\Models\LaporanPendapatan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with(['penyimpanan', 'pesanan'])->latest()->get();
        return view('pembayaran.index', compact('pembayaran'));
    }

    public function create()
    {
        $penyimpanan = Penyimpanan::all();
        $pesanan = Pesanan::all();
        return view('pembayaran.create', compact('penyimpanan', 'pesanan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_penyimpanan' => 'required|exists:penyimpanan,id_penyimpanan',
            'id_pesanan' => 'required|exists:pesanan,id_pesanan',
            'tanggal_pengambilan' => 'nullable|date',
            'metode_pembayaran' => 'required|string|max:20',
        ]);

        // Auto-calculate price based on jenis_cucian and berat
        $pesanan = Pesanan::findOrFail($validated['id_pesanan']);
        $hargaPerKg = $pesanan->jenis_cucian === 'Express' ? 10000 : 7000;
        $validated['harga_per_jenis_cucian'] = $hargaPerKg * $pesanan->berat;

        $pembayaran = Pembayaran::create($validated);
        
        // Auto-create laporan pendapatan
        LaporanPendapatan::create([
            'id_pembayaran' => $pembayaran->id_pembayaran,
            'subtotal' => $pembayaran->harga_per_jenis_cucian,
        ]);
        
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan');
    }

    public function show($id)
    {
        $pembayaran = Pembayaran::with(['penyimpanan', 'pesanan', 'laporanPendapatan'])->findOrFail($id);
        return view('pembayaran.show', compact('pembayaran'));
    }

    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $penyimpanan = Penyimpanan::all();
        $pesanan = Pesanan::all();
        return view('pembayaran.edit', compact('pembayaran', 'penyimpanan', 'pesanan'));
    }

    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        
        $validated = $request->validate([
            'id_penyimpanan' => 'required|exists:penyimpanan,id_penyimpanan',
            'id_pesanan' => 'required|exists:pesanan,id_pesanan',
            'tanggal_pengambilan' => 'nullable|date',
            'metode_pembayaran' => 'required|string|max:20',
        ]);

        // Auto-calculate price based on jenis_cucian and berat
        $pesanan = Pesanan::findOrFail($validated['id_pesanan']);
        $hargaPerKg = $pesanan->jenis_cucian === 'Express' ? 10000 : 7000;
        $validated['harga_per_jenis_cucian'] = $hargaPerKg * $pesanan->berat;

        $pembayaran->update($validated);
        
        // Update or create laporan pendapatan
        LaporanPendapatan::updateOrCreate(
            ['id_pembayaran' => $pembayaran->id_pembayaran],
            ['subtotal' => $pembayaran->harga_per_jenis_cucian]
        );
        
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil diupdate');
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran deleted successfully');
    }
}
