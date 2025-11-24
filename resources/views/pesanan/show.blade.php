@extends('layouts.app')

@section('header', 'Detail Pesanan')

@section('content')
<div class="max-w-4xl">
    <div class="mb-6">
        <a href="{{ route('pesanan.index') }}" class="text-purple-600 hover:text-purple-800 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h3 class="text-2xl font-bold text-gray-800">Pesanan #ORD-{{ str_pad($pesanan->id_pesanan, 3, '0', STR_PAD_LEFT) }}</h3>
                <p class="text-gray-500 mt-1">{{ $pesanan->tanggal_masuk->format('d F Y') }}</p>
            </div>
            <a href="{{ route('pesanan.edit', $pesanan->id_pesanan) }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                Edit
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Nama Pelanggan</label>
                <p class="text-gray-800 font-medium">{{ $pesanan->nama_pelanggan }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">No HP</label>
                <p class="text-gray-800 font-medium">{{ $pesanan->no_hp }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Jenis Cucian</label>
                <p class="text-gray-800 font-medium">{{ $pesanan->jenis_cucian }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">Berat</label>
                <p class="text-gray-800 font-medium">{{ $pesanan->berat }} Kg</p>
            </div>
        </div>

        @if($pesanan->cucian)
        <div class="border-t pt-6">
            <h4 class="text-lg font-semibold text-gray-800 mb-4">Informasi Cucian</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">No Pesanan</label>
                    <p class="text-gray-800 font-medium">{{ $pesanan->cucian->no_pesanan }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                    @if($pesanan->cucian->status_cucian == 'Proses')
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                            Proses
                        </span>
                    @else
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                            Selesai
                        </span>
                    @endif
                </div>
                @if($pesanan->cucian->penyimpanan)
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Lokasi Rak</label>
                    <p class="text-gray-800 font-medium">{{ $pesanan->cucian->penyimpanan->lokasi_rak }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Simpan</label>
                    <p class="text-gray-800 font-medium">{{ $pesanan->cucian->penyimpanan->tanggal_simpan->format('d M Y') }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
