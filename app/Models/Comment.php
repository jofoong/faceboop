<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function post()
    {
        //Each comment can only belong to one post
        return $this->belongsTo('App\Models\Post');
    }

    public function user()
    {
        //Each comment can only belong to one post
        return $this->belongsTo('App\Models\User');
    }
}
