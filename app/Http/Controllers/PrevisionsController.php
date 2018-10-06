<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Technologie;
use App\Projet;
use App\Application;
use App\Plan;
use App\Departement;
use App\Application_Technologie;
use \PDF;

class PrevisionsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->except(['createClient','store']);
	}
	public function index()
	{
		
		$previsions= Application::where('prevision','PA');
		if ($id= request('plan')){
			$plan=Plan::find($id);
			$previsions=$plan->applications->where('prevision','PA')->sortByDesc('created_at');
			
		}
		else{
			$plan=Plan::where('actuel',1)->first();
			if (!$plan)
			return view('errors.vide');
			$previsions=$previsions->where('plan_id',$plan->id)->where('prevision','PA')->orderBy('created_at','desc')->get();
			
		}

		return view('previsions.show',compact('previsions'));
	}
	public function create()
	{
		$departements=Departement::all();
		$technologies=Technologie::all();
		return view('previsions.create',compact('technologies','departements'));
	}
	public function createClient()
	{
		$departements=Departement::all();
		$technologies=Technologie::all();
		return view('Client.previsions.create',compact('technologies','departements'));
	}
	public function store()
	{
		$nature_client=array('Interne','Externe');
		if (!in_array(request('nature_client'),$nature_client))
			return back()->withErrors('Nature du client non valide');
		$departements=Departement::pluck('designation')->toArray();
		if (!in_array(request('client'),$departements))
			return back()->withErrors('Département non valide');
		if (request('nature_client')=='Interne')
			$client=request('clientt');
		else
			$client=request('client');	

		$plan=Plan::where('actuel',1)->first();
		if (!$plan){
			return view("errors.vide");
		}
		$this->validate(request(),[
			'app_name'=>'required|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/|min:2|max:40',
			'nature_client'=>'required|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/',
			'date_prevu_prod'=>'required|date|after:today',
			'autre_tech'=>'regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/'
		],[
			
			'app_name.required'=>'Veuillez préciser le nom de l\'application',
			'app_name.regex'=>'Le nom de l\'application est invalide',
			'app_name.min'=>'Le nom de l\'application doit dépasser 2 caractères',
			'app_name.max'=>'Le nom de l\'application ne doit pas dépasser 40 caractères',
			'date_prevu_prod.required'=>'Veuillez préciser la date prévue pour passage en production',
			'nature_client.regex'=>'la nature du client est invalide',
			'nature_client.required'=>'veuillez préciser la nature du client',
			'date_prevu_prod.after'=>'La date prévue pour passage en production est invalide',
			'autre_tech.regex'=>'Autre technologie invalide'
		]);
		$app=Application::create ([
			'nom'=>request('app_name'),
			'nature_client'=>request('nature_client'),
			'client'=>$client,
			'date_prevu_prod'=>request('date_prevu_prod'),
			
			'plan_id'=>$plan['id']
		]);
		if(request('autre_tech')!=''){
			$app->update(['autre_tech'=>request('autre_tech')]);
		}
		$app_id=$app->id;
		if($techs= request('tech')){
		foreach ($techs as $tech=>$value) {
			
			$app->technologies()->attach($value);
		}
		}
		if (auth()->check()) {
				return redirect('/previsions/');
		}
		else{
			return redirect('/Client_previsions_create');
		}
	
	}
	public function validePrevisions()
	{
		if ($id= request('plan')){
			$plan=Plan::find($id);
			
		}
		else{
			$plan=Plan::where('actuel',1)->first();

			
		}
			$previsions=$plan->applications->where('isValid', 1)->where('prevision','PA')->sortByDesc('created_at');
		return view('previsions.show',compact('previsions'));
	}
	public function invalidePrevisions()
	{
		if ($id= request('plan')){
			$plan=Plan::find($id);
			
		}
		else{
			$plan=Plan::where('actuel',1)->first();
		}
			$previsions=$plan->applications->where('isValid', 0)->where('prevision','PA')->sortByDesc('created_at');
		return view('previsions.show',compact('previsions'));
	}
	public function showPrevision( $application)
	{
		$application= Application::find($application);
		return view('previsions.showOne',compact('application'));
	}
	public function validatePrevision($id)
	{
		$application=Application::find($id);
		$application->update(['isValid'=>true]);
		return back();
	}



	public function deletePrevision()
	{
		$application=Application::find(request('id'));
		$application->delete();
		$application->technologies()->detach();
		return redirect('/previsions');

	}
	public function editPrevision($id)
	{
		$technologies=Technologie::all();
		$application=Application::find($id);
		$departements=Departement::all();
		return view('previsions.update',compact('application','technologies','departements'));
	}
	public function updatePrevision($id)
	{
		 $nature_client=array('Interne','Externe');
                if (!in_array(request('nature_client'),$nature_client))
                return back()->withErrors('Nature du client non valide');
                $departements=Departement::pluck('id')->toArray();
                if (!in_array(request('client'),$departements))
                return back()->withErrors('Département non valide');

		$application=Application::find($id);
		$this->validate(request(),[
			'app_name'=>'required|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/|min:2|max:40',
			'nature_client'=>'required|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/',
			'date_prevu_prod'=>'required|date|after:today'
		],[
			
			'app_name.required'=>'Veuillez préciser le nom de l\'application',
			'app_name.regex'=>'Le nom de l\'application est invalide',
			'app_name.min'=>'Le nom de l\'application doit dépasser 2 caractères',
			'app_name.max'=>'Le nom de l\'application ne doit pas dépasser 40 caractères',
			'date_prevu_prod.required'=>'Veuillez préciser la date prévue pour passage en production',
			'nature_client.regex'=>'la nature du client est invalide',
			'nature_client.required'=>'veuillez préciser la nature du client',
			'date_prevu_prod.after'=>'La date prévue pour passage en production est invalide'
		]);
		$application->update([
			'nom'=>request('app_name'),
			'nature_client'=>request('nature_client'),
			'client'=> request('client'),
			'autre_tech'=>request('autre_tech'),
			'date_prevu_prod'=>request('date_prevu_prod')

		]);
		if(!request('autre')){
			$application->update(['autre_tech'=>null]);
		}
		$techs=Technologie::all();
		foreach ($techs as $tech=>$value) {
			$application->technologies()->detach($value);
		}

		if($techs= request('tech')){

		foreach ($techs as $tech=>$value) {	
			$application->technologies()->attach($value);
		}
		}
		return redirect('/previsions/'.$id);
	}
	
}
