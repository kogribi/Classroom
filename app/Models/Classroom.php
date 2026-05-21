<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Classroom extends Model
{
    protected $fillable = [
    'user_id',
    'name',
    'code',
    'description'
    ];

 public function joins()
{
    return $this->hasMany(Join::class);
}
public function homeworks()
{
    return $this->hasMany(Homework::class, 'class_id');
}
}
