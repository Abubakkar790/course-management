<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'stream_id'];

    public function stream()
    {
        return $this->belongsTo(Stream::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'subject_users');
    }
}
