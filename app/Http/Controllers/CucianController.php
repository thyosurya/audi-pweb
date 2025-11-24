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
            'no_pesanan' => 'required|string|max:20',
            'status_cucian' => 'required|string|max:20',
        ]);

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
        $pesanan = Pesanan::all();
        return view('cucian.edit', compact('cucian', 'pesanan'));
    }

    public function update(Request $request, $id)
    {
        $cucian = Cucian::findOrFail($id);
        
        $validated = $request->validate([
            'id_pesanan' => 'required|exists:pesanan,id_pesanan',
            'no_pesanan' => 'required|string|max:20',
            'status_cucian' => 'required|string|max:20',
        ]);

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
