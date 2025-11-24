<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cucian extends Model
{
    protected $table = 'cucian';
    protected $primaryKey = 'id_cucian';
    public $incrementing = true;

    protected $fillable = [
        'id_pesanan',
        'no_pesanan',
        'status_cucian',
    ];

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan', 'id_pesanan');
    }

    public function penyimpanan(): HasOne
    {
        return $this->hasOne(Penyimpanan::class, 'id_cucian', 'id_cucian');
    }
}
