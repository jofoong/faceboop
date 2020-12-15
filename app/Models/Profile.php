<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['bio', 'location', 'breed'];

    public function dog()
    {
        //Each profile is associated with only one Dog
        return $this->belongsTo('App\Models\Dog');
    }
}
