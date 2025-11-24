@extends('layouts.app')

@section('header', 'Edit Status Cucian')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('cucian.index') }}" class="text-purple-600 hover:text-purple-800 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Edit Cucian {{ $cucian->no_pesanan }}</h3>

        <form action="{{ route('cucian.update', $cucian->id_cucian) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label for="id_pesanan" class="block text-sm font-medium text-gray-700 mb-2">Pesanan</label>
                    <select id="id_pesanan" name="id_pesanan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                        <option value="">Pilih Pesanan</option>
                        @foreach($pesanan as $p)
                            <option value="{{ $p->id_pesanan }}" {{ old('id_pesanan', $cucian->id_pesanan) == $p->id_pesanan ? 'selected' : '' }}>
                                #ORD-{{ str_pad($p->id_pesanan, 3, '0', STR_PAD_LEFT) }} - {{ $p->nama_pelanggan }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_pesanan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="no_pesanan" class="block text-sm font-medium text-gray-700 mb-2">No Pesanan</label>
                    <input type="text" id="no_pesanan" name="no_pesanan" value="{{ old('no_pesanan', $cucian->no_pesanan) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                    @error('no_pesanan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status_cucian" class="block text-sm font-medium text-gray-700 mb-2">Status Cucian</label>
                    <select id="status_cucian" name="status_cucian" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                        <option value="">Pilih Status</option>
                        <option value="Proses" {{ old('status_cucian', $cucian->status_cucian) == 'Proses' ? 'selected' : '' }}>Proses</option>
                        <option value="Selesai" {{ old('status_cucian', $cucian->status_cucian) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status_cucian')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('cucian.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
