<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = [
        'nombre',
        'email',
        'password',
        'licencia_expires_at',
        'secret_hash',
        'ip_sesion',
        'firma',
    ];
}
