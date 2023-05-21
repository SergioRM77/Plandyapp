<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clave_recuperacion_cuenta extends Model
{
    protected $table = "claves_recuperacion_cuenta";
    use HasFactory;
    protected $fillable = [
        'usuario_id',
        'num_recuperacion'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];
}
