@extends('layouts.app')

@section('header', 'Tambah Pembayaran')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('pembayaran.index') }}" class="text-purple-600 hover:text-purple-800 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <h3 class="text-xl font-bold text-gray-800 mb-6">Form Pembayaran Baru</h3>

        <form action="{{ route('pembayaran.store') }}" method="POST">
            @csrf

            <div class="space-y-6">
                <div>
                    <label for="id_pesanan" class="block text-sm font-medium text-gray-700 mb-2">Pesanan</label>
                    <select id="id_pesanan" name="id_pesanan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                        <option value="">Pilih Pesanan</option>
                        @foreach($pesanan as $p)
                            <option value="{{ $p->id_pesanan }}" 
                                data-jenis="{{ $p->jenis_cucian }}" 
                                data-berat="{{ $p->berat }}"
                                {{ old('id_pesanan') == $p->id_pesanan ? 'selected' : '' }}>
                                #ORD-{{ str_pad($p->id_pesanan, 3, '0', STR_PAD_LEFT) }} - {{ $p->nama_pelanggan }} ({{ $p->jenis_cucian }} - {{ $p->berat }}kg)
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
                            <option value="{{ $s->id_penyimpanan }}" {{ old('id_penyimpanan') == $s->id_penyimpanan ? 'selected' : '' }}>
                                {{ $s->lokasi_rak }} - {{ $s->cucian->pesanan->nama_pelanggan ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_penyimpanan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="harga_display" class="block text-sm font-medium text-gray-700 mb-2">Total Harga</label>
                    <div class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-800 font-semibold text-lg" id="harga_display">
                        Rp 0
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Harga dihitung otomatis: Express Rp 10.000/kg | Reguler Rp 7.000/kg</p>
                </div>

                <div>
                    <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                    <select id="metode_pembayaran" name="metode_pembayaran" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500" required>
                        <option value="">Pilih Metode</option>
                        <option value="Cash" {{ old('metode_pembayaran') == 'Cash' ? 'selected' : '' }}>Cash</option>
                        <option value="Transfer" {{ old('metode_pembayaran') == 'Transfer' ? 'selected' : '' }}>Transfer</option>
                        <option value="QRIS" {{ old('metode_pembayaran') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                    </select>
                    @error('metode_pembayaran')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_pengambilan" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pengambilan <span class="text-gray-400 text-xs">(Opsional)</span></label>
                    <input type="date" id="tanggal_pengambilan" name="tanggal_pengambilan" value="{{ old('tanggal_pengambilan') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    <p class="mt-1 text-xs text-gray-500">Kosongkan jika pesanan belum diambil</p>
                    @error('tanggal_pengambilan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('pembayaran.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
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

<script>
document.getElementById('id_pesanan').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const jenis = selectedOption.getAttribute('data-jenis');
    const berat = parseFloat(selectedOption.getAttribute('data-berat'));
    
    if (jenis && berat) {
        const hargaPerKg = jenis === 'Express' ? 10000 : 7000;
        const totalHarga = hargaPerKg * berat;
        document.getElementById('harga_display').textContent = 'Rp ' + totalHarga.toLocaleString('id-ID');
    } else {
        document.getElementById('harga_display').textContent = 'Rp 0';
    }
});
</script>
@endsection
