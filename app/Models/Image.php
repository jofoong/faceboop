<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
    ];

    public function post()
    {
        //Each image can only belong to one user
        return $this->belongsTo('App\Models\Post');
    }
}
