<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'first_name', 'last_name', 'phone', 'email', 'password', 'state', 'city', 'address', 'postal_code', 'type'
    ];

    public $incrementing = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function is_admin ($user_id)
    {
        return ($this->type == 1) ? true : false;   
    }
    
    /**
     * Relation to Article model
     *
     * @return Article Model
     */
    public function articles ()
    {
        return $this->hasMany(\App\Models\Article::class);
    }

    /**
     * Relation to Product model
     *
     * @return Product Model
     */
    public function products ()
    {
        return $this->hasMany(\App\Models\Product::class);
    }

    /**
     * Relation to Review model
     *
     * @return Review Model
     */
    public function reviews ()
    {
        return $this->hasMany(\App\Models\Review::class);
    }

    /**
     * Full_name Mutators
     *
     * @return String
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
