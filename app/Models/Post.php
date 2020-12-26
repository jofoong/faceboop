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
    protected $guarded = ['user_id'];

    public function comments()
    {
        //Each post has a one-to-many r/s with Comments
        return $this->hasMany('App\Models\Comment');
    }

    public function user()
    {
        //Each post is written by a user
        return $this->belongsTo('App\Models\User'); 
    }

    public function tags()
    {
        //Multiple Posts can have multiple Tags
        return $this->belongsToMany('App\Models\Tag'); 
    }

    public function image()
    {
        //A Post has a one-to-one r/s with its Image
        return $this->hasOne('App\Models\Image');
    }
}
