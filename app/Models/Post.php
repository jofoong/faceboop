<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content'];

    public function comments()
    {
        //Each post has a one-to-many r/s with Comments
        return $this->hasMany('App\Models\Comment');
    }

    public function dog()
    {
        //Each post is written by a Dog
        return $this->belongsTo('App\Models\Dog'); 
    }

    public function tags()
    {
        //Multiple Posts can have multiple Tags
        return $this->belongsToMany('App\Models\Tag'); 
    }
}
