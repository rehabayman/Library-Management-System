<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    public function rateBooks()
    {
        return $this->belongsToMany('App\Book', 'user_rate_books');
    }
    public function commentsOnBooks(){
        return $this->belongsToMany('App\Book', 'user_commentedon_books');
    }
    public function favoriteBooks(){
        return $this->belongsToMany('App\Book', 'user_favorite_books');
    }
    public function leaseBooks(){
        return $this->belongsToMany('App\Book', 'user_lease_books');
    }
    protected $fillable = ['name', 'username', 'role', 'phone', 'profile_pic', 'active', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at', 'deleted_at'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'boolean'
    ];

    protected $dates = ['email_verified_at', 'created_at', 'updated_at', 'deleted_at'];

}
