<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat_evento extends Model
{
    protected $table = "chats_eventos";
    use HasFactory;
    protected $fillable = [
        'evento_id',
        'usuario_id',
        'fecha_y_hora',
        'contenido'
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
