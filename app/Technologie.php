<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technologie extends Model
{
     protected $guarded=['id'];
    public function applications()
    {
    	return $this->belongsToMany(Application::class);
    }
}
