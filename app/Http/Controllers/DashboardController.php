<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Cucian;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalPesanan = Pesanan::count();
        $cucianProses = Cucian::where('status_cucian', 'Proses')->count();
        $cucianSelesai = Cucian::where('status_cucian', 'Selesai')->count();
        $pendapatanHariIni = Pembayaran::whereDate('created_at', today())->sum('harga_per_jenis_cucian');
        
        $recentOrders = Pesanan::with(['cucian.penyimpanan'])
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('totalPesanan', 'cucianProses', 'cucianSelesai', 'pendapatanHariIni', 'recentOrders'));
    }

    public function owner()
    {
        return view('owner.dashboard');
    }
}
