<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Projet;
class Procedure extends Model
{
     protected $guarded=['id'];
     public function projets()
     {
     	return $this->hasMany(Projet::class);
     }

}
