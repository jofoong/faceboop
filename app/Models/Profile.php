<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['bio', 'location', 'breed'];

    public function user()
    {
        //Each profile is associated with only one user
        return $this->belongsTo('App\Models\User');
    }

    public function image()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    /*
    public function image()
    {
        return $this->hasOne('App\Models\Image');
    }
    */
}
