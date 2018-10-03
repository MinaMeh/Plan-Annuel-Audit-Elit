<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Serveur;

class Application extends Model
{
    //
    protected $guarded = ['id'];


    public function technologies()
    {
    	return $this->belongsToMany(Technologie::class);
    }

    public function plan()
    {
    	return $this->belongsTo(Plan::class);
    }
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function appusers()
    {
        return $this->hasMany(Userapp::class);
    }
    public function serveurs()
    {
        return $this->hasMany(Serveur::class);
    }
    public function projets()
    {
        return $this->hasMany(Projet::class);
    }
   
}	
