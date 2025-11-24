@extends('layouts.app')

@section('header', 'Dashboard')

@section('content')
<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Pesanan -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-purple-50 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm font-medium">Total Pesanan</h3>
            <div class="p-2 bg-purple-50 rounded-lg">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
        </div>
        <div class="flex items-baseline">
            <h2 class="text-3xl font-bold text-gray-800">{{ $totalPesanan }}</h2>
        </div>
    </div>

    <!-- Cucian Proses -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-purple-50 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm font-medium">Cucian Proses</h3>
            <div class="p-2 bg-yellow-50 rounded-lg">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <div class="flex items-baseline">
            <h2 class="text-3xl font-bold text-gray-800">{{ $cucianProses }}</h2>
            <span class="ml-2 text-sm text-gray-400 font-medium">Sedang dikerjakan</span>
        </div>
    </div>

    <!-- Cucian Selesai -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-purple-50 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm font-medium">Cucian Selesai</h3>
            <div class="p-2 bg-green-50 rounded-lg">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <div class="flex items-baseline">
            <h2 class="text-3xl font-bold text-gray-800">{{ $cucianSelesai }}</h2>
            <span class="ml-2 text-sm text-gray-400 font-medium">Siap diambil</span>
        </div>
    </div>

    <!-- Pendapatan Hari Ini -->
    <div class="bg-white rounded-xl p-6 shadow-sm border border-purple-50 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-500 text-sm font-medium">Pendapatan Hari Ini</h3>
            <div class="p-2 bg-pink-50 rounded-lg">
                <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
        <div class="flex items-baseline">
            <h2 class="text-3xl font-bold text-gray-800">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h2>
        </div>
    </div>
</div>

<!-- Recent Orders Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-800">Pesanan Terbaru</h3>
        <a href="{{ route('pesanan.index') }}" class="text-sm text-purple-600 font-medium hover:text-purple-800">Lihat Semua</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-sm uppercase tracking-wider">
                    <th class="px-6 py-4 font-medium">No Resi</th>
                    <th class="px-6 py-4 font-medium">Nama Pelanggan</th>
                    <th class="px-6 py-4 font-medium">Berat (Kg)</th>
                    <th class="px-6 py-4 font-medium">Status</th>
                    <th class="px-6 py-4 font-medium">Rak Penyimpanan</th>
                    <th class="px-6 py-4 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($recentOrders as $pesanan)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-gray-800 font-medium">#ORD-{{ str_pad($pesanan->id_pesanan, 3, '0', STR_PAD_LEFT) }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $pesanan->nama_pelanggan }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $pesanan->berat }} Kg</td>
                    <td class="px-6 py-4">
                        @if($pesanan->cucian)
                            @if($pesanan->cucian->status_cucian == 'Proses')
                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                    Proses
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                    Selesai
                                </span>
                            @endif
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                Belum Diproses
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        @if($pesanan->cucian && $pesanan->cucian->penyimpanan)
                            <span class="flex items-center">
                                <span class="w-2 h-2 bg-purple-400 rounded-full mr-2"></span>
                                {{ $pesanan->cucian->penyimpanan->lokasi_rak }}
                            </span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('pesanan.show', $pesanan->id_pesanan) }}" class="text-gray-400 hover:text-purple-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        Belum ada pesanan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
