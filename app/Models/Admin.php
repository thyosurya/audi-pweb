<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
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
