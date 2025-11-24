@extends('layouts.app')

@section('header', 'Edit Pembayaran')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('pembayaran.index') }}" class="text-purple-600 hover:text-purple-800 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Edit Pembayaran #PAY-{{ str_pad($pembayaran->id_pembayaran, 3, '0', STR_PAD_LEFT) }}</h3>

        <form action="{{ route('pembayaran.update', $pembayaran->id_pembayaran) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label for="id_pesanan" class="block text-sm font-medium text-gray-700 mb-2">Pesanan</label>
                    <select id="id_pesanan" name="id_pesanan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                        <option value="">Pilih Pesanan</option>
                        @foreach($pesanan as $p)
                            <option value="{{ $p->id_pesanan }}" {{ old('id_pesanan', $pembayaran->id_pesanan) == $p->id_pesanan ? 'selected' : '' }}>
                                #ORD-{{ str_pad($p->id_pesanan, 3, '0', STR_PAD_LEFT) }} - {{ $p->nama_pelanggan }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_pesanan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="id_penyimpanan" class="block text-sm font-medium text-gray-700 mb-2">Penyimpanan</label>
                    <select id="id_penyimpanan" name="id_penyimpanan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                        <option value="">Pilih Penyimpanan</option>
                        @foreach($penyimpanan as $s)
                            <option value="{{ $s->id_penyimpanan }}" {{ old('id_penyimpanan', $pembayaran->id_penyimpanan) == $s->id_penyimpanan ? 'selected' : '' }}>
                                {{ $s->lokasi_rak }} - {{ $s->cucian->pesanan->nama_pelanggan ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_penyimpanan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="harga_per_jenis_cucian" class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                    <input type="number" step="0.01" id="harga_per_jenis_cucian" name="harga_per_jenis_cucian" value="{{ old('harga_per_jenis_cucian', $pembayaran->harga_per_jenis_cucian) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                    @error('harga_per_jenis_cucian')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                    <select id="metode_pembayaran" name="metode_pembayaran" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                        <option value="">Pilih Metode</option>
                        <option value="Cash" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'Cash' ? 'selected' : '' }}>Cash</option>
                        <option value="Transfer" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'Transfer' ? 'selected' : '' }}>Transfer</option>
                        <option value="QRIS" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                    </select>
                    @error('metode_pembayaran')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_pengambilan" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pengambilan</label>
                    <input type="date" id="tanggal_pengambilan" name="tanggal_pengambilan" value="{{ old('tanggal_pengambilan', $pembayaran->tanggal_pengambilan ? $pembayaran->tanggal_pengambilan->format('Y-m-d') : '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    @error('tanggal_pengambilan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('pembayaran.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
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
