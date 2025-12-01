<?php

namespace App\Http\Controllers;

use App\Models\LaporanPendapatan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPendapatanController extends Controller
{
    public function index()
    {
        $laporan = LaporanPendapatan::with('pembayaran.pesanan')->latest()->get();
        
        // Get monthly data for chart (SQLite compatible)
        $monthlyData = LaporanPendapatan::selectRaw("CAST(strftime('%m', created_at) AS INTEGER) as month, CAST(strftime('%Y', created_at) AS INTEGER) as year, SUM(subtotal) as total")
            ->whereYear('created_at', date('Y'))
            ->groupBy('year', 'month')
            ->orderBy('month')
            ->get();
        
        // Get daily data for current month (last 30 days)
        $dailyData = LaporanPendapatan::selectRaw("DATE(created_at) as date, SUM(subtotal) as total")
            ->where('created_at', '>=', now()->subDays(29)->startOfDay())
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        // Calculate total revenue
        $totalPendapatan = LaporanPendapatan::sum('subtotal');
        $pendapatanBulanIni = LaporanPendapatan::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->sum('subtotal');
        $totalTransaksi = LaporanPendapatan::count();
        
        return view('owner.laporan', compact('laporan', 'monthlyData', 'dailyData', 'totalPendapatan', 'pendapatanBulanIni', 'totalTransaksi'));
    }
    
    public function admin()
    {
        $laporan = LaporanPendapatan::with('pembayaran.pesanan')->latest()->get();
        
        // Get monthly data for chart (SQLite compatible)
        $monthlyData = LaporanPendapatan::selectRaw("CAST(strftime('%m', created_at) AS INTEGER) as month, CAST(strftime('%Y', created_at) AS INTEGER) as year, SUM(subtotal) as total")
            ->whereYear('created_at', date('Y'))
            ->groupBy('year', 'month')
            ->orderBy('month')
            ->get();
        
        // Calculate total revenue
        $totalPendapatan = LaporanPendapatan::sum('subtotal');
        $pendapatanBulanIni = LaporanPendapatan::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->sum('subtotal');
        $totalTransaksi = LaporanPendapatan::count();
        
        return view('admin.laporan', compact('laporan', 'monthlyData', 'totalPendapatan', 'pendapatanBulanIni', 'totalTransaksi'));
    }
    
    public function exportPdf()
    {
        $laporan = LaporanPendapatan::with('pembayaran.pesanan')->latest()->get();
        $totalPendapatan = LaporanPendapatan::sum('subtotal');
        $pendapatanBulanIni = LaporanPendapatan::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->sum('subtotal');
        $totalTransaksi = LaporanPendapatan::count();
        
        $pdf = Pdf::loadView('laporan.pdf', compact('laporan', 'totalPendapatan', 'pendapatanBulanIni', 'totalTransaksi'));
        return $pdf->download('laporan-pendapatan-' . date('Y-m-d') . '.pdf');
    }

    public function exportDailyPdf()
    {
        // Get today's data only
        $laporan = LaporanPendapatan::with('pembayaran.pesanan')
            ->whereDate('created_at', date('Y-m-d'))
            ->latest()
            ->get();
        
        $totalPendapatan = $laporan->sum('subtotal');
        $totalTransaksi = $laporan->count();
        $tanggal = date('d F Y');
        
        $pdf = Pdf::loadView('laporan.daily-pdf', compact('laporan', 'totalPendapatan', 'totalTransaksi', 'tanggal'));
        return $pdf->download('laporan-harian-' . date('Y-m-d') . '.pdf');
    }

    public function create()
    {
        $pembayaran = Pembayaran::all();
        return view('laporan.create', compact('pembayaran'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pembayaran' => 'required|exists:pembayaran,id_pembayaran',
            'subtotal' => 'required|numeric|min:0',
        ]);

        LaporanPendapatan::create($validated);
        return redirect()->route('laporan.index')->with('success', 'Laporan created successfully');
    }

    public function show($id)
    {
        $laporan = LaporanPendapatan::with('pembayaran')->findOrFail($id);
        return view('laporan.show', compact('laporan'));
    }

    public function edit($id)
    {
        $laporan = LaporanPendapatan::findOrFail($id);
        $pembayaran = Pembayaran::all();
        return view('laporan.edit', compact('laporan', 'pembayaran'));
    }

    public function update(Request $request, $id)
    {
        $laporan = LaporanPendapatan::findOrFail($id);
        
        $validated = $request->validate([
            'id_pembayaran' => 'required|exists:pembayaran,id_pembayaran',
            'subtotal' => 'required|numeric|min:0',
        ]);

        $laporan->update($validated);
        return redirect()->route('laporan.index')->with('success', 'Laporan updated successfully');
    }

    public function destroy($id)
    {
        $laporan = LaporanPendapatan::findOrFail($id);
        $laporan->delete();
        return redirect()->route('laporan.index')->with('success', 'Laporan deleted successfully');
    }
}
