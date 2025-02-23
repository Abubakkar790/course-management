<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stream extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 
        'image',
    ];

    public function users() 
    {
        return $this->hasMany(User::class);
    }

    public function subjects() 
    {
        return $this->hasMany(Subject::class);
    }
}
