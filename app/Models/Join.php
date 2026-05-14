<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Join extends Model
{
    protected $fillable = [
    'user_id',
    'class_id',
    ];

 public function joins()
{
    return $this->belongsTo(Classroom::class);
}
}
