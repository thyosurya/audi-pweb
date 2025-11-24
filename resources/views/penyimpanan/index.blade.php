@extends('layouts.app')

@section('header', 'Lokasi Penyimpanan')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h3 class="text-2xl font-bold text-gray-800">Daftar Penyimpanan</h3>
        <p class="text-gray-600 mt-1">Kelola lokasi rak penyimpanan</p>
    </div>
    <a href="{{ route('penyimpanan.create') }}" class="flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors shadow-md">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Tambah Penyimpanan
    </a>
</div>

@if(session('success'))
<div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
    {{ session('success') }}
</div>
@endif

<!-- Rak Grid Visualization -->
<div class="mb-8 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <h4 class="text-lg font-semibold text-gray-800 mb-4">Visual Rak Penyimpanan</h4>
    <div class="grid grid-cols-4 md:grid-cols-8 gap-3">
        @foreach(['A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'B1', 'B2', 'B3', 'B4', 'B5', 'B6', 'B7', 'B8'] as $rak)
            @php
                $occupied = $penyimpanan->where('lokasi_rak', 'Rak ' . $rak)->first();
            @endphp
            <div class="aspect-square rounded-lg border-2 flex items-center justify-center text-sm font-medium transition-all
                {{ $occupied ? 'border-purple-400 bg-purple-50 text-purple-700' : 'border-gray-200 bg-gray-50 text-gray-400' }}">
                {{ $rak }}
            </div>
        @endforeach
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-sm uppercase tracking-wider">
                    <th class="px-6 py-4 font-medium">Lokasi Rak</th>
                    <th class="px-6 py-4 font-medium">No Pesanan</th>
                    <th class="px-6 py-4 font-medium">Nama Pelanggan</th>
                    <th class="px-6 py-4 font-medium">Tanggal Simpan</th>
                    <th class="px-6 py-4 font-medium">Status</th>
                    <th class="px-6 py-4 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($penyimpanan as $item)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <span class="flex items-center">
                            <span class="w-2 h-2 bg-purple-400 rounded-full mr-2"></span>
                            <span class="text-gray-800 font-medium">{{ $item->lokasi_rak }}</span>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $item->cucian->no_pesanan ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $item->cucian->pesanan->nama_pelanggan ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $item->tanggal_simpan->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        @if($item->cucian && $item->cucian->status_cucian == 'Selesai')
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                Selesai
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                Proses
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('penyimpanan.edit', $item->id_penyimpanan) }}" class="text-purple-600 hover:text-purple-800">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('penyimpanan.destroy', $item->id_penyimpanan) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        Belum ada data penyimpanan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
