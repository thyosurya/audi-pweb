<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pesanan;
use App\Models\Cucian;
use App\Models\Penyimpanan;
use App\Models\Pembayaran;
use App\Models\LaporanPendapatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password', // Will be hashed by 'hashed' cast in User model
        ]);

        // Owner User
        $owner = User::create([
            'name' => 'Owner',
            'email' => 'owner@example.com',
            'password' => 'password',
        ]);

        // Seed legacy/specific tables
        // Note: Passwords here are plain text due to varchar(25) limit in migration
        \Illuminate\Support\Facades\DB::table('admin')->insert([
            'id_user' => $admin->id,
            'username' => 'admin',
            'password' => 'password',
        ]);

        \Illuminate\Support\Facades\DB::table('owner')->insert([
            'id_user' => $owner->id,
            'username' => 'owner',
            'password' => 'password',
        ]);

        // Seed dummy data
        $jenisCucian = ['Reguler', 'Express'];
        $statusCucian = ['Proses', 'Selesai'];
        $lokasiRak = ['A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'B1', 'B2', 'B3', 'B4', 'B5', 'B6', 'B7', 'B8'];
        $metodePembayaran = ['Tunai', 'Transfer', 'QRIS', 'Debit'];

        for ($i = 1; $i <= 20; $i++) {
            // Create Pesanan
            $pesanan = Pesanan::create([
                'nama_pelanggan' => fake()->name(),
                'no_hp' => fake()->numerify('08##########'),
                'jenis_cucian' => fake()->randomElement($jenisCucian),
                'berat' => fake()->randomFloat(2, 1, 15),
                'tanggal_masuk' => fake()->dateTimeBetween('-30 days', 'now'),
            ]);

            // Create Cucian
            $cucian = Cucian::create([
                'id_pesanan' => $pesanan->id_pesanan,
                'no_pesanan' => 'ORD-' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'status_cucian' => fake()->randomElement($statusCucian),
            ]);

            // Create Penyimpanan
            $penyimpanan = Penyimpanan::create([
                'id_cucian' => $cucian->id_cucian,
                'tanggal_simpan' => fake()->dateTimeBetween($pesanan->tanggal_masuk, 'now'),
                'lokasi_rak' => fake()->randomElement($lokasiRak),
            ]);

            // Create Pembayaran
            $hargaPerJenis = match($pesanan->jenis_cucian) {
                'Pakaian' => 8000,
                'Sepatu' => 15000,
                'Tas' => 20000,
                'Selimut' => 25000,
                'Boneka' => 12000,
                'Karpet' => 30000,
                default => 10000,
            };

            $pembayaran = Pembayaran::create([
                'id_penyimpanan' => $penyimpanan->id_penyimpanan,
                'id_pesanan' => $pesanan->id_pesanan,
                'harga_per_jenis_cucian' => $hargaPerJenis,
                'tanggal_pengambilan' => $cucian->status_cucian === 'Selesai' 
                    ? fake()->dateTimeBetween($penyimpanan->tanggal_simpan, 'now')
                    : null,
                'metode_pembayaran' => fake()->randomElement($metodePembayaran),
            ]);

            // Create Laporan Pendapatan
            $subtotal = $pesanan->berat * $hargaPerJenis;
            LaporanPendapatan::create([
                'id_pembayaran' => $pembayaran->id_pembayaran,
                'subtotal' => $subtotal,
            ]);
        }
    }
}
