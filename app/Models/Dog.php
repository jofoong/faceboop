<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Dog extends Authenticatable
{
    use HasFactory, Notifiable;

    public function profile()
    {
        //A Dog has a one-to-one r/s with its Profile
        return $this->hasOne('App\Models\Profile');
    }

    public function posts()
    {
        //Each Dog has a one-to-many r/s with Posts
        return $this->hasMany('App\Models\Post');
    }
    
    public function comments()
    {
        //Each dog has a one-to-many r/s with Comments
        return $this->hasMany('App\Models\Comment');
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username'
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