<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectComment extends Model
{
    protected $fillable = ['project_id', 'user_id', 'content'];

public function user()
{
    return $this->belongsTo(User::class);
}
}


