<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //create ta3 eloquent model
     protected $guarded=['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function projets()
    {
        return $this->belongsToMany(Projet::class);
    }
     public function setPasswordAttribute($value)
    {
        if( \Hash::needsRehash($value) ) {
            $value = \Hash::make($value);
        }
        $this->attributes['password'] = $value;
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
