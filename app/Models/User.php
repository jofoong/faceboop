<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function profile()
    {
        //A User has a one-to-one r/s with its Profile
        return $this->hasOne('App\Models\Profile');
    }

    public function posts()
    {
        //Each User has a one-to-many r/s with Posts
        return $this->hasMany('App\Models\Post');
    }
    
    public function comments()
    {
        //Each User has a one-to-many r/s with Comments
        return $this->hasMany('App\Models\Comment');
    }
    
    public function images()
    {
        //Each User has a one-to-many r/s with Images
        return $this->hasMany('App\Models\Image');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        //'username'
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}