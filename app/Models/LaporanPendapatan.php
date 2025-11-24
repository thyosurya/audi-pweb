<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanPendapatan extends Model
{
    protected $table = 'laporan_pendapatan';
    protected $primaryKey = 'id_laporan';
    public $incrementing = true;

    protected $fillable = [
        'id_pembayaran',
        'subtotal',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
    ];

    public function pembayaran(): BelongsTo
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembayaran', 'id_pembayaran');
    }
}
