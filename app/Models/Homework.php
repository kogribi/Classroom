<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    protected $fillable = [
    'class_id',
    'title',
    'file',
    'file_names',
    'description',
    'due_date',
    ];

    protected $casts = [
    'file' => 'array',
    'file_names' => 'array',
    'due_date'   => 'date',
    ];
    
public function homeworks()
{
    return $this->belongsTo(Classroom::class, 'class_id');
}
}
