<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Projet;
use App\Controle;
use App\Vulnerabilite;
class ResultsController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function showVulnerabilities()
	{
		$projets=Projet::where('etat','en audit')->orWhere('etat','cloturé')->orWhere('etat','attendre la bonne version')->orWhere('etat','=','audit cloturé')->get();
		return view('resultats.show',compact('projets'));
	}
	public function showVulnerabilitiesTypes()
	{
		$projets=Projet::where('etat','en audit')->orWhere('etat','cloturé')->orWhere('etat','attendre la bonne version')->orWhere('etat','=','audit cloturé')->get();
		$vulnerabilites=Vulnerabilite::all();
		return view('resultats.vulnerabilities',compact('projets','vulnerabilites'));
	}

	public function updateVuln()
	{
		$projet=Projet::find(request('id'));
		$projet->update([request('colomn')=>request('val')]);
		$vuln=$projet->vuln_faibles+$projet->vuln_moyennes+$projet->vuln_eleves;
		return Response($vuln);
	}
	public function showControles()
	{
		$projets=Projet::where('etat','en audit')->orWhere('etat','cloturé')->orWhere('etat','attendre la bonne version')->get();
		$controles=Controle::all();
		return view('resultats.controles',compact('projets','controles'));
	}
	public function updateProjetControle()
	{
		\DB::table('controle_projet')
            ->where('controle_id', request('controle'))
            ->where('projet_id',request('projet'))
            ->update(['nbr' => request('nbr')]);
	}
	public function updateProjetVuln()
	{
		\DB::table('projet_vulnerabilite')
            ->where('vulnerabilite_id', request('vuln'))
            ->where('projet_id',request('projet'))
            ->update(['nbr' => request('nbr')]);
	}
}
