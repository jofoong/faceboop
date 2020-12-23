<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'url',
    ];

    public function user()
    {
        //Each image can only belong to one user
        return $this->belongsTo('App\Models\User');
    }
}
