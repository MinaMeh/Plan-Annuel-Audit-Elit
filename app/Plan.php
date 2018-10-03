<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $guarded=['id'];



public function applications()
{
	return $this->hasMany(Application::class);
}
public function projets()
{
	return $this->hasMany(Projet::class);
}
}