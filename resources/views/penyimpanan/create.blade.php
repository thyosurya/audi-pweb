@extends('layouts.app')

@section('header', 'Tambah Penyimpanan')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('penyimpanan.index') }}" class="text-purple-600 hover:text-purple-800 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Form Penyimpanan Baru</h3>

        <form action="{{ route('penyimpanan.store') }}" method="POST">
            @csrf

            <div class="space-y-6">
                <div>
                    <label for="id_cucian" class="block text-sm font-medium text-gray-700 mb-2">Cucian</label>
                    <select id="id_cucian" name="id_cucian" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                        <option value="">Pilih Cucian</option>
                        @foreach($cucian as $c)
                            <option value="{{ $c->id_cucian }}" {{ old('id_cucian') == $c->id_cucian ? 'selected' : '' }}>
                                {{ $c->no_pesanan }} - {{ $c->pesanan->nama_pelanggan ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_cucian')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="lokasi_rak" class="block text-sm font-medium text-gray-700 mb-2">Lokasi Rak</label>
                    <select id="lokasi_rak" name="lokasi_rak" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                        <option value="">Pilih Rak</option>
                        @foreach(['A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'B1', 'B2', 'B3', 'B4', 'B5', 'B6', 'B7', 'B8'] as $rak)
                            <option value="Rak {{ $rak }}" {{ old('lokasi_rak') == "Rak $rak" ? 'selected' : '' }}>Rak {{ $rak }}</option>
                        @endforeach
                    </select>
                    @error('lokasi_rak')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_simpan" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Simpan</label>
                    <input type="date" id="tanggal_simpan" name="tanggal_simpan" value="{{ old('tanggal_simpan', date('Y-m-d')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                    @error('tanggal_simpan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('penyimpanan.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
