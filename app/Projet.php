<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Application;
use App\Controle;
use App\Reaudit;
use App\Vulnerabilite;
class Projet extends Model
{
	protected $guarded=['id'];
    //
    public function users()
    {
    	return $this->belongsToMany(User::class);
    }
    public function procedure()
    {
    	return $this->belongsTo(Procedure::class);
    }
    public function application()
    {
    	return $this->belongsTo(Application::class);
    }
    public function controles()
    {
        return $this->belongsToMany(Controle::class)->withPivot('nbr');
    }
    public function vulnerabilites()
    {
        return $this->belongsToMany(Vulnerabilite::class)->withPivot('nbr');
    }
    public function reaudits()
    {
        return $this->hasMany(Reaudit::class);
    }
}
