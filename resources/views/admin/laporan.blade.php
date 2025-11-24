@extends('layouts.app')

@section('header', 'Laporan Pendapatan')

@section('content')
<div class="flex flex-col space-y-6">
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-purple-50">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-gray-500 text-sm font-medium">Total Pendapatan</h3>
                <div class="p-2 bg-purple-50 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-purple-50">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-gray-500 text-sm font-medium">Bulan Ini</h3>
                <div class="p-2 bg-green-50 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h2>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-sm border border-purple-50">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-gray-500 text-sm font-medium">Total Transaksi</h3>
                <div class="p-2 bg-pink-50 rounded-lg">
                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">{{ $totalTransaksi }}</h2>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Pendapatan Bulanan {{ date('Y') }}</h3>
            <a href="{{ route('laporan.pdf') }}" class="flex items-center px-4 py-2 bg-white border border-purple-600 text-purple-600 rounded-lg hover:bg-purple-50 transition-colors shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                Download PDF
            </a>
        </div>
        
        @php
            $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
            $monthlyTotals = array_fill(0, 12, 0);
            $maxTotal = 1;
            
            foreach($monthlyData as $data) {
                $monthlyTotals[$data->month - 1] = $data->total;
                if($data->total > $maxTotal) {
                    $maxTotal = $data->total;
                }
            }
        @endphp
        
        <div class="w-full h-64 bg-gray-50 rounded-lg flex items-end justify-between px-4 pb-4 space-x-2">
            @foreach($monthlyTotals as $index => $total)
                @php
                    $height = $maxTotal > 0 ? ($total / $maxTotal) * 100 : 0;
                    $colors = ['bg-purple-200', 'bg-purple-300', 'bg-purple-400', 'bg-pink-300', 'bg-purple-500', 'bg-purple-600'];
                    $hoverColors = ['hover:bg-purple-300', 'hover:bg-purple-400', 'hover:bg-purple-500', 'hover:bg-pink-400', 'hover:bg-purple-600', 'hover:bg-purple-700'];
                    $colorIndex = $index % 6;
                @endphp
                <div class="w-full {{ $colors[$colorIndex] }} rounded-t {{ $hoverColors[$colorIndex] }} transition-colors relative group" style="height: {{ max($height, 5) }}%">
                    <div class="absolute -top-10 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex justify-between mt-4 text-xs text-gray-500">
            @foreach($months as $month)
                <span>{{ $month }}</span>
            @endforeach
        </div>
    </div>

    <!-- Data List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800">Riwayat Transaksi</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-sm uppercase tracking-wider">
                        <th class="px-6 py-4 font-medium">Tanggal</th>
                        <th class="px-6 py-4 font-medium">ID Transaksi</th>
                        <th class="px-6 py-4 font-medium">Pelanggan</th>
                        <th class="px-6 py-4 font-medium">Jenis Cucian</th>
                        <th class="px-6 py-4 font-medium text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($laporan as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-gray-600">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-gray-800 font-medium">#TRX-{{ str_pad($item->id_laporan, 4, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $item->pembayaran->pesanan->nama_pelanggan ?? '-' }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $item->pembayaran->pesanan->jenis_cucian ?? '-' }}</td>
                        <td class="px-6 py-4 text-right font-bold text-green-600">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            Belum ada data laporan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                @if($laporan->count() > 0)
                <tfoot class="bg-gray-50 border-t-2 border-gray-200">
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-right font-bold text-gray-800">Total Keseluruhan:</td>
                        <td class="px-6 py-4 text-right font-bold text-purple-600 text-lg">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
</div>
@endsection
