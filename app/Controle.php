<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Controle extends Model
{
     protected $guarded=['id'];
    public function projets()
    {
    	return $this->belongsToMany(Projet::class);
    }
}
