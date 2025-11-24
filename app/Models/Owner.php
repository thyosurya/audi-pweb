<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $table = 'owner';
    protected $primaryKey = 'id_user';
    public $incrementing = true;

    protected $fillable = [
        'id_user',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
