<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Penyimpanan extends Model
{
    protected $table = 'penyimpanan';
    protected $primaryKey = 'id_penyimpanan';
    public $incrementing = true;

    protected $fillable = [
        'id_cucian',
        'tanggal_simpan',
        'lokasi_rak',
    ];

    protected $casts = [
        'tanggal_simpan' => 'date',
    ];

    public function cucian(): BelongsTo
    {
        return $this->belongsTo(Cucian::class, 'id_cucian', 'id_cucian');
    }

    public function pembayaran(): HasOne
    {
        return $this->hasOne(Pembayaran::class, 'id_penyimpanan', 'id_penyimpanan');
    }
}
