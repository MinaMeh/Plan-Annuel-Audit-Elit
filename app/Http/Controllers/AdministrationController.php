<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Technologie;
use App\Procedure;
use App\User;
use App\Projet;

use App\Departement;
use App\Type;
use App\Role;
use App\Controle;
use App\Vulnerabilite;
class AdministrationController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function show()
	{
		$types=Type::all();
		$technologies=Technologie::all();
		$procedures=Procedure::all();
		$users=User::all();
		$departements=Departement::all();
		$roles=Role::all();
		$controles=Controle::all();
		$vulnerabilites=Vulnerabilite::all();
    return view ('administration.show',compact('technologies','procedures','users','departements','types','roles','controles','vulnerabilites'));
	}
	public function addTechnologie()
	{
		$this->validate(request(),[
			'designation'=>'required|min:2|max:12|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/',
			'description'=>'regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/'
		],[
			'designation.regex'=>'veuillez saisir une désignation valide',
			'description.regex'=>'veuillez saisir une description valide',	
			'designation.required'=>'veuillez préciser la désignation'	,
			'designation.min'=>'la désignation doit dépasser deux caractères',	
			'designation.max'=>'la désignation ne doit pas dépasser 12 caractères'
		]);
		Technologie::create([
			'designation'=>request('designation'),
			'description'=>request('description')
		]);
		return redirect('/administration');
	}
	public function addDepartement()
	{
		$this->validate(request(),[
			'designation'=>'required|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/|min:2|max:40',
			'nature'=>'required|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/'
		],[
			'designation.required'=>'veuillez préciser la désignation',
			'designation.regex'=>'veuillez donner une désignation valide',
			'designation.min'=>'la désignation doit dépasser 2 caractères',
			'designation.max'=>'la désignation ne doit pas dépasser 40 caractères',
			'nature.required'=>'veuillez donner une nature valide',
			'nature.required'=>'veuillez préciser la nature du département'	
		]);
		Departement::create([
			'designation'=>request('designation'),
			'nature'=>request('nature')
		]);
		return redirect('/administration');
	}
	public function addProcedure(Request $request)
	{
		$this->validate(request(),[
			'designation'=>'required|regex:/^[a-zA-Z0-9\séàè’\']+$/|min:2|max:150',
			'code'=>'required|regex:/^[a-zA-Z0-9\s-éàèôûêç’\']+$/|min:2|max:5',
			'file'=>'mimes:pdf,doc,docx'
		],[
			'designation.required'=>'veuillez préciser la désignation',
			'designation.regex'=>'veuillez préciser une désignation valide',
			'designation.min'=>'la désignation doit dépasser 2 caractères',
			'designation.max'=>'la désignation ne doit pas dépasser 60 caractères',
			'code.required'=>'veuillez préciser le code',
			'code.regex'=>'veuillez préciser un code valide',
			'code.min'=>'le code doit dépasser 2 caractères',
			'code.max'=>'le code ne doit pas dépasser 60 caractères',
			'file.mimes'=>'le type du fichier n\'est pas valide'
		]);
		$extension=array('pdf','doc','docx');
		if ($file=$request->file('file')){

		 	if (!in_array($file->getClientOriginalExtension(),$extension))
		 		return back()->withErrors('fichier de type invalide');
		 }
		$procedure=Procedure::create([
			'designation'=>request('designation'),
			'code'=>request('code')
		]);
		
			if ($file=$request->file('file')) {
		 	\Storage::disk('procedures')->put($file->getClientOriginalName(), file_get_contents($file -> getRealPath()));
		 	$procedure->update(['file'=>$file->getClientOriginalName()]);
		 } 
		return redirect('/administration');
	}
    public function addType()
	{
		$this->validate(request(),[
			'designation'=>'required|min:2|max:12|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/',
			'description'=>'regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/'
		],[
			'designation.regex'=>'veuillez saisir une désignation valide',
			'description.regex'=>'veuillez saisir une description valide',	
			'designation.required'=>'veuillez préciser la désignation'	,
			'designation.min'=>'la désignation doit dépasser deux caractères',	
			'designation.max'=>'la désignation ne doit pas dépasser 12 caractères'
		]);
		Type::create([
			'designation'=>request('designation'),
			'description'=>request('description')
		]);
		return redirect('/administration');
	}
	 
	 public function addControle()
	{
		$this->validate(request(),[
			'designation'=>'required|min:2|max:40|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/',
			'description'=>'regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/'
		],[
			'designation.regex'=>'veuillez saisir une désignation valide',
			'description.regex'=>'veuillez saisir une description valide',	
			'designation.required'=>'veuillez préciser la désignation'	,
			'designation.min'=>'la désignation doit dépasser deux caractères',	
			'designation.max'=>'la désignation ne doit pas dépasser 40 caractères'
		]);
		$controle=Controle::create([
			'designation'=>request('designation'),
			'description'=>request('description')
		]);
		$projets=Projet::where('etat','en audit')->orWhere('etat','=','cloturé')->orWhere('etat','=','attendre la bonne version')->orWhere('etat','=','audit cloturé')->get();
		foreach ($projets as $projet) {
			$projet->controles()->attach($controle->id);
		}
		return redirect('/administration');
	}
	 public function addVulnerabilite()
	{
		$this->validate(request(),[
			'designation'=>'required|min:2|max:40|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/',
			'description'=>'regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/'
		],[
			'designation.regex'=>'veuillez saisir une désignation valide',
			'description.regex'=>'veuillez saisir une description valide',	
			'designation.required'=>'veuillez préciser la désignation'	,
			'designation.min'=>'la désignation doit dépasser deux caractères',	
			'designation.max'=>'la désignation ne doit pas dépasser 40 caractères'
		]);
		$vulnerabilite=Vulnerabilite::create([
			'designation'=>request('designation'),
			'description'=>request('description')
		]);
		$projets=Projet::all();
		foreach ($projets as $projet) {
			$projet->vulnerabilites()->attach($vulnerabilite->id);
		}
		return redirect('/administration');
	}
	public function addRole()
	{
		$this->validate(request(),[
			'designation'=>'required|min:2|max:12|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/',
		],[
			'designation.regex'=>'veuillez saisir une désignation valide',
			'designation.required'=>'veuillez préciser la désignation'	,
			'designation.min'=>'la désignation doit dépasser deux caractères',	
			'designation.max'=>'la désignation ne doit pas dépasser 12 caractères'
		]);
		Role::create(['designation'=>request('designation')]);	
		return redirect('/administration');
	}
	public function addUser()
	{
		$this->validate(request(),[
			'name'=>'required|regex:/^[a-zA-Z0-9\séàèôûêç._’\']+$/|min:2|max:30',
			'email'=>'required|email',
			'password'=>'required|min:8|regex:/^.*(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!$#%]).*$/',
			'role'=>'required'
		],[
			'name.required'=>'veuillez préciser le nom de l\'utilisateur',	
			'name.regex'=>'veuillez donner un nom d\'utilisateur valide',		
			'name.min'=>'le nom d\'utilisateur doit dépasser 2 caractères',		
			'name.max'=>'le nom d\'utilisateur ne doit pas dépasser 30 caractères',		

			'email.required'=>'veuillez préciser l\'email de l\'utilisateur',
			'password.required'=>'veuillez préciser le mot de passe de l\'utilisateur',
			'password.regex'=>'Mot de passe faible! le mot de passe doit contenir un caractère miniscule, un caractère majuscule, un chiffre et un caractère spécial',
			'role.required'=>'veuillez préciser le rôle de l\'utilisateur',
			'password.min'=>'Le mot de passe doit dépasser 8 caractères',
			'email.email'=>'le champs email doit être un email valide'

		]);
		$user=User::create([
			'name'=>request('name'),
			'email'=>request('email'),
			'password'=>request('password'),
			'role_id'=>request('role')
		]);
		return redirect('/administration');
	}

	//modifier une technologie
	public function modifierTechnologie(Request $request)
	{
		$technologie=Technologie::find(request('id'));
		$this->validate(request(),[
			'designation'=>'required|min:2|max:12|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/',
			'description'=>'regex:/^[a-zA-Z0-9\s]éàèôûêç’\'+$/'
		],[
			'designation.regex'=>'veuillez saisir une désignation valide',
			'description.regex'=>'veuillez saisir une description valide',	
			'designation.required'=>'veuillez préciser la désignation'	,
			'designation.min'=>'la désignation doit dépasser deux caractères',	
			'designation.max'=>'la désignation ne doit pas dépasser 12 caractères'
		]);
		$technologie->update(['designation'=>request('designation'),'description'=>request('description')]);
		return redirect('/administration');
	}
	//modifier un département
	public function modifierDepartement(Request $request)
	{
		$departement=Departement::find(request('id'));
		$this->validate(request(),[
			'designation'=>'required|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/|min:2|max:40',
			'nature'=>'required|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/'
		],[
			'designation.required'=>'veuillez préciser la désignation',
			'designation.regex'=>'veuillez donner une désignation valide',
			'designation.min'=>'la désignation doit dépasser 2 caractères',
			'designation.max'=>'la désignation ne doit pas dépasser 40 caractères',
			'nature.required'=>'veuillez donner une nature valide',
			'nature.required'=>'veuillez préciser la nature du département'	
		]);
		$departement->update(['designation'=>request('designation'),'nature'=>request('nature')]);
		return redirect('/administration');
	}
	//modifier un type
	public function modifierType(Request $request)
	{
		$type=Type::find(request('id'));
		$this->validate(request(),[
			'designation'=>'required|min:2|max:12|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/',
			'description'=>'regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/'
		],[
			'designation.regex'=>'veuillez saisir une désignation valide',
			'description.regex'=>'veuillez saisir une description valide',	
			'designation.required'=>'veuillez préciser la désignation'	,
			'designation.min'=>'la désignation doit dépasser deux caractères',	
			'designation.max'=>'la désignation ne doit pas dépasser 12 caractères'
		]);
		$type->update(['designation'=>request('designation'),'description'=>request('description')]);
		return redirect('/administration');
	}

	
	public function modifierVulnerabilite(Request $request)
	{
		$vulnerabilite=Vulnerabilite::find(request('id'));
		$this->validate(request(),[
			'designation'=>'required|min:2|max:12|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/',
			'description'=>'regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/'
		],[
			'designation.regex'=>'veuillez saisir une désignation valide',
			'description.regex'=>'veuillez saisir une description valide',	
			'designation.required'=>'veuillez préciser la désignation'	,
			'designation.min'=>'la désignation doit dépasser deux caractères',	
			'designation.max'=>'la désignation ne doit pas dépasser 12 caractères'
		]);
		$vulnerabilite->update(['designation'=>request('designation'),'description'=>request('description')]);
		return redirect('/administration');
	}
	public function modifierControle(Request $request)
	{
		$controle=Controle::find(request('id'));
		$this->validate(request(),[
			'designation'=>'required|min:2|max:12|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/',
			'description'=>'regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/'
		],[
			'designation.regex'=>'veuillez saisir une désignation valide',
			'description.regex'=>'veuillez saisir une description valide',	
			'designation.required'=>'veuillez préciser la désignation'	,
			'designation.min'=>'la désignation doit dépasser deux caractères',	
			'designation.max'=>'la désignation ne doit pas dépasser 12 caractères'
		]);
		$controle->update(['designation'=>request('designation'),'description'=>request('description')]);
		return redirect('/administration');
	}
	public function modifierProcedure(Request $request)
	{
		$procedure=Procedure::find(request('id'));
		$this->validate(request(),[
			'designation'=>'required|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/|min:2|max:150',
			'code'=>'required|regex:/^[a-zA-Z0-9\s-éàèôûêç’\']+$/|min:2|max:5',
			'file'=>'mimes:pdf,doc,docx'
		],[
			'designation.required'=>'veuillez préciser la désignation',
			'designation.regex'=>'veuillez préciser une désignation valide',
			'designation.min'=>'la désignation doit dépasser 2 caractères',
			'designation.max'=>'la désignation ne doit pas dépasser 60 caractères',
			'code.required'=>'veuillez préciser le code',
			'code.regex'=>'veuillez préciser un code valide',
			'code.min'=>'le code doit dépasser 2 caractères',
			'code.max'=>'le code ne doit pas dépasser 60 caractères',
			'file.mimes'=>'le type du fichier n\'est pas valide'
		]);
		$extension=array('pdf','doc','docx');

		if ($file=$request->file('file')){

		 	if (!in_array($file->getClientOriginalExtension(),$extension))
		 		return back()->withErrors('fichier de type invalide');
		 }
		$procedure->update([
			'designation'=>request('designation'),
			'code'=>request('code')
		]);
		if ($file=$request->file('file')) {
		 	\Storage::disk('procedures')->put($file->getClientOriginalName(), file_get_contents($file -> getRealPath()));
		 	$procedure->update(['file'=>$file->getClientOriginalName()]);
		 } 
		return redirect('/administration');
	}
	public function modifierUser(Request $request)
	{
		$user=User::find(request('id'));
		$this->validate(request(),[
			'name'=>'required|regex:/^[a-zA-Z0-9\séàèôûêç._’\']+$/|min:2|max:30',
			'email'=>'required|email',
			'role'=>'required'
		],[
			'name.required'=>'veuillez préciser le nom de l\'utilisateur',	
			'name.regex'=>'veuillez donner un nom d\'utilisateur valide',		
			'name.min'=>'le nom d\'utilisateur doit dépasser 2 caractères',		
			'name.max'=>'le nom d\'utilisateur ne doit pas dépasser 30 caractères',		
			'email.required'=>'veuillez préciser l\'email de l\'utilisateur',
			'role.required'=>'veuillez préciser le rôle de l\'utilisateur',
			'password.min'=>'Le mot de passe doit dépasser 8 caractères',
			'email.email'=>'le champs email doit être un email valide',

		]);
		$user->update([
			'name'=>request('name'),
			'email'=>request('email'),
			'role_id'=>request('role')
		]);
		if (request('password')) {
			$this->validate(request(),[
			'password'=>'min:8|regex:/^.*(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!$#%]).*$/'
		],[
			'password.min'=>'Le mot de passe doit dépasser 8 caractères',
			'password.regex'=>'Mot de passe faible! le mot de passe doit contenir un caractère miniscule, un caractère majuscule, un chiffre et un caractère spécial'
			
		]);

			$user->update(['password'=>request('password')]);
			
		}
		return redirect('/administration');
	}
	public function supprimerTechnologie()
	{
		$tech=Technologie::find(request('id'));
		if (!$tech->applications->first()){

			$tech->delete();
			return redirect('/administration');
		}
		else {
			return redirect('/administration')->with('TechError','impossible');
			
		}
	}
		public function supprimerType()
	{

		$type=Type::find(request('id'));

		if (!$type->applications->first()){
			$type->delete();
			return redirect('/administration');
		}
		else {
			return redirect('/administration')->with('TypeError','impossible');
		}
	}
		public function supprimerDepartement()
	{
		$departement=Departement::find(request('id'));
		$departement->delete();
		return redirect('/administration');
		
	}
	public function supprimerControle()
	{
		$controle=Controle::find(request('id'));
		$controle->delete();
		return redirect('/administration');
		
	}
	public function supprimerVulnerabilite()
	{
		$vulnerabilite=Vulnerabilite::find(request('id'));
		$vulnerabilite->delete();
		return redirect('/administration');
		
	}
		public function supprimerProcedure()
	{
		$procedure=Procedure::find(request('id'));

		
		if (!$procedure->projets->first()){
			$procedure->delete();
			return redirect('/administration');
		}
		else {
			return redirect('/administration')->with('procedureError','impossible');
		}
	}
		public function supprimerUser()
	{
		$user=User::find(request('id'));
		if (!$user->projets->first()){
			$user->delete();
			return redirect('/administration');
		}
		else{
			return redirect('/administration')->with('UserError','impossible');
		}
	}
	function getProcedureFiche($id)
	{
		$procedure=Procedure::find($id);
		$path=storage_path('documents') . ('/FichesProcedures/').$procedure->file;
		return response()->file($path);

	}

}
