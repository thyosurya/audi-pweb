<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';
    public $incrementing = true;

    protected $fillable = [
        'nama_pelanggan',
        'no_hp',
        'jenis_cucian',
        'berat',
        'tanggal_masuk',
    ];

    protected $casts = [
        'berat' => 'decimal:2',
        'tanggal_masuk' => 'date',
    ];

    public function cucian(): HasOne
    {
        return $this->hasOne(Cucian::class, 'id_pesanan', 'id_pesanan');
    }
}
