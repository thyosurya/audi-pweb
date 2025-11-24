<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    public $incrementing = true;

    protected $fillable = [
        'id_penyimpanan',
        'id_pesanan',
        'harga_per_jenis_cucian',
        'tanggal_pengambilan',
        'metode_pembayaran',
    ];

    protected $casts = [
        'harga_per_jenis_cucian' => 'decimal:2',
        'tanggal_pengambilan' => 'date',
    ];

    public function penyimpanan(): BelongsTo
    {
        return $this->belongsTo(Penyimpanan::class, 'id_penyimpanan', 'id_penyimpanan');
    }

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }

    public function laporanPendapatan(): HasOne
    {
        return $this->hasOne(LaporanPendapatan::class, 'id_pembayaran', 'id_pembayaran');
    }
}
