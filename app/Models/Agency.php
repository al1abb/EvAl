<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }
}
