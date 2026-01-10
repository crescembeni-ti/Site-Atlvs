<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    // LISTA DE CAMPOS PERMITIDOS PARA SALVAR
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'status',
        'deadline',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function files()
{
    return $this->hasMany(ProjectFile::class);
}

public function comments()
{
    return $this->hasMany(ProjectComment::class)->latest();
}

}