<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Projet;
class Vulnerabilite extends Model
{
    //
     protected $guarded=['id'];

     public function projets()
     {
     	return $this->belongsToMany(Proje::class)->withPivot('nbr');
     }
}
