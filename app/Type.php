<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Application;
class Type extends Model
{
    //
     protected $guarded=['id'];
     public function applications()
     {
     	return $this->hasMany(Application::class);
     }
}
