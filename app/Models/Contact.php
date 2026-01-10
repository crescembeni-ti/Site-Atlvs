<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Lista de campos que podem ser gravados/alterados
    protected $fillable = [
        'name',
        'email',
        'message',
        'is_read', // <--- ADICIONE ISTO AQUI
    ];

    // Converte automaticamente 0/1 do banco para true/false no código
    protected $casts = [
        'is_read' => 'boolean',
    ];
}