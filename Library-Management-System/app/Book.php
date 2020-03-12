<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model  
{

    
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'books';
    public function usersCommented()
    {
        return $this->belongsToMany('App\User', 'user_commentedon_books');
    }
    public function Comments()
    {
        return $this->hasMany('App\UserCommentedonBooks');
    }
    public function usersRate()
    {
        return $this->belongsToMany('App\User', 'user_rate_books');
    }
    public function usersFavorite(){
        return $this->belongsToMany('App\User', 'user_favorite_books');
    }
    public function usersLease(){
        return $this->belongsToMany('App\User', 'user_lease_books');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'author', 'description', 'total_rating', 'price', 'profit_precentage', 'num_of_copies', 'publish_date', 'category_id', 'created_at','num_of_copies', 'updated_at', 'deleted_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['publish_date', 'created_at', 'updated_at', 'deleted_at'];

}
