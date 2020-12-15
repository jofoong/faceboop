<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function posts()
    {
        //Multiple Tags can be in multiple Posts
        return $this->belongsToMany('App\Models\Post'); 
    }
}
