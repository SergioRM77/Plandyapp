<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_evento extends Model
{
    protected $table  = "users_eventos";
    use HasFactory;
    protected $fillable = [
        'evento_id',
        'user_id',
        'is_admin_principal',
        'is_admin_secundario'
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
