@extends('layouts.app')

@section('header', 'Tambah Pesanan')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('pesanan.index') }}" class="text-purple-600 hover:text-purple-800 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Form Pesanan Baru</h3>

        <form action="{{ route('pesanan.store') }}" method="POST">
            @csrf

            <div class="space-y-6">
                <div>
                    <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700 mb-2">Nama Pelanggan</label>
                    <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                    @error('nama_pelanggan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">No HP</label>
                    <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                    @error('no_hp')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="jenis_cucian" class="block text-sm font-medium text-gray-700 mb-2">Jenis Cucian</label>
                    <select id="jenis_cucian" name="jenis_cucian" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                        <option value="">Pilih Jenis</option>
                        <option value="Cuci Kering" {{ old('jenis_cucian') == 'Cuci Kering' ? 'selected' : '' }}>Cuci Kering</option>
                        <option value="Cuci Basah" {{ old('jenis_cucian') == 'Cuci Basah' ? 'selected' : '' }}>Cuci Basah</option>
                        <option value="Setrika" {{ old('jenis_cucian') == 'Setrika' ? 'selected' : '' }}>Setrika</option>
                        <option value="Cuci Setrika" {{ old('jenis_cucian') == 'Cuci Setrika' ? 'selected' : '' }}>Cuci Setrika</option>
                    </select>
                    @error('jenis_cucian')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="berat" class="block text-sm font-medium text-gray-700 mb-2">Berat (Kg)</label>
                    <input type="number" step="0.01" id="berat" name="berat" value="{{ old('berat') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                    @error('berat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_masuk" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Masuk</label>
                    <input type="date" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk', date('Y-m-d')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                    @error('tanggal_masuk')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('pesanan.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
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
