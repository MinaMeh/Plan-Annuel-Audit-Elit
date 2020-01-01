<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Projet;
use App\Http\Requests;
use App\Type;
use App\Plan;
use App\User;
use App\Role;
use App\Application;
use App\Technologie;
use App\Departement;
use \PDF;
class DemandsController extends Controller
{
	public function __construct()
	{
		        $this->middleware('auth')->only('showDemande','updateDemande','index','create','createNPdemand','supprimerDemande','editDemande','validateDemande','valideDemands','invalideDemands,getDocumentation');

 	public function create()
	{
		$types= Type::all();
		$clients=Application::all()->pluck('client')->unique();
		return view ('demands.create',compact('types','clients'));
	}
	public function createClient()
	{
		$types= Type::all();
		$clients=Application::all()->pluck('client')->unique();
		return view ('Client.demands.create',compact('types','clients'));
	}
	public function createNPdemand()
	{
		$types=Type::all();
		$technologies=Technologie::all();
		$departements=Departement::all();
		return view('demands.create_NP',compact('types','technologies','departements'));
	}
	public function createNPClient()
	{
		$types=Type::all();
		$technologies=Technologie::all();
		$departements=Departement::all();
		return view('Client.demands.create_NP',compact('types','technologies','departements'));
	}
	public function store(Request $request)
	{
		$plan=Plan::where('actuel',true)->first();
		 $nature_client=Departement::pluck('nature')->toArray();
                if (!in_array(request('nature_client'),$nature_client))
                return back()->withErrors('Nature du client non valide');
                $departements=Departement::pluck('designation')->toArray();
                if (!in_array(request('client'),$departements))
                return back()->withErrors('Département non valide');
		 $types=Type::pluck('id')->toArray();
                if (!in_array(request('type_app'),$types))
                return back()->withErrors('Type de l\'application non valide');

		$this->validate(request(),[
			'nature_client'=>'bail|required|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/',
			'client'=>'bail|required|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/|max:40',
			'chef_projet'=>'bail|required|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/',
			'email_chef_projet'=>'bail|required|email|min:2|max:60',
			'type_app'=>'bail|required|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/',
			'documentation'=>'bail|mimes:pdf,doc,docx,ppt,pptx'
			
		],[
			'client.required'=>'veuillez préciser le client',
			'client.regex'=>'veuillez préciser un client valide',
			'client.max'=>'le client ne doit pas dépasser 40 caractères',
			'nature_client.required'=>'veuillez préciser la nature du client',
			'chef_projet.required'=>'veuillez préciser le chef du projet',
			'chef_projet.regex'=>'Le nom du chef du projet n\'est pas valide',
			'email_chef_projet.required'=>'veuillez préciser l\'email du chef du projet',
			'email_chef_projet.email'=>'l\'email du chef du projet n\'est pas valide',
			'email_chef_projet.min'=>'l\'email du chef du projet n\'est pas valide',
			'email_chef_projet.max'=>'l\'email du chef du projet ne doit pas dépasser 60 caractères',
			'documentation.mimes'=>'La documentation n\'est pas de type valide', 
			'type_app.required'=>'veuillez préciser le type de l\'application'

		]
		);
		$extension=array('pdf','doc','docx','ppt','pptx');
		if ($file=$request->file('documentation')){

		 	if (!in_array($file->getClientOriginalExtension(),$extension))
		 		return back()->withErrors('fichier de type invalide');
		 }

		$app=Application::find(request('nom'));
		if ($exist=Projet::where('application_id','=',$app->id)->first()){
			return dd('impossible');
		}
		if($file=$request->file('documentation')){
			\Storage::disk('documentations')->put($file->getClientOriginalName(), file_get_contents($file -> getRealPath()));
			
			$app->update(['documentation'=>$file->getClientOriginalName()]);
		}
		$app->update([
			'chef_projet'=>request('chef_projet'),
			'email_chef_projet'=>request('email_chef_projet'),
			'version'=>request('version'),
			'type_id'=>request('type_app')
			
		]);
		if (request('new_name')){
			$app->update(['nom'=> request('new_name')]);
		}
		Projet::create([
			'etat'=>'reçu',
			'application_id'=>$app->id,
			'plan_id'=>$plan->id,

			'date_reception'=> \Carbon\Carbon::now()
		]);
		
		$role=Role::where('designation','=','admin')->first();
		$users =User::where('role_id','=',$role->id)->get();
		foreach ($users as $user) {
			\Mail::send('emails.demandeSent', ['user' => $user], function ($message) use ($user)
        {

            $message->from('planaudit@elit.dz', 'Plan Audit');

            $message->to($user->email);

            $message->subject("Demande d'audit");

        });
		}
			if (auth()->check()) {
								

				return view('demands.create2',compact('app'));
			}
			else{
				
				return view('Client.demands.create2',compact('app'));
			}
		

	}
	public function storeStep2()
	{
		$app=Application::find(request('app_id'));
		$app->projets->first()->delete();
		$app->update([
			'chef_projet'=>null,
			'email_chef_projet'=>null,
			'version'=>null,
			'type_id'=>null,
			'documentation'=>null
		]);
		if (auth()->check()) {
				return redirect('/demandes/');
			}
			else{
				return redirect('/Client_demandes_create');
			}
	}
	public function storeNPStep1(Request $request)
	{
		$plan=Plan::where('actuel',true)->first();
		 $nature_client=Departement::pluck('nature')->toArray();
                if (!in_array(request('nature_client_np'),$nature_client))
                return back()->withErrors('Nature du client non valide');
                $departements=Departement::pluck('designation')->toArray();
                if (!in_array(request('client_np'),$departements))
                return back()->withErrors('Département non valide');
		 $types=Type::pluck('id')->toArray();
                if (!in_array(request('type_app_np'),$types))
                return back()->withErrors('Type de l\'application non valide');


		if (request('nature_client_np')=='Interne') {
			$client=request('client_np');
		}
		else {
			$client=request('client_npe');
		}
		//dd ($today,strtotime($today));
		$this->validate(request(),[
			'nature_client_np'=>'bail|required|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/',
			'client_np'=>'bail|required|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/|max:40',
			'chef_projet_np'=>'bail|required|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/',
			'date_prevu_prod_np'=>'bail|required|date|after: today',
			'nom_app_np'=>'bail|required|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/',
			'email_chef_projet_np'=>'bail|required|email|min:2|max:60',
			'type_app_np'=>'bail|required|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/',
			'documentation_np'=>'bail|mimes:pdf,doc,docx,ppt,pptx',
			'autre_tech'=>'regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/'
			
		],[
			'client_np.required'=>'veuillez préciser le client',
			'client_np.regex'=>'veuillez préciser un client valide',
			'nature_client_np.required'=>'le nature du client est invalide',
			'nature_client_np.regex'=>'la nature du client est invalide',
			'client_np.max'=>'le client ne doit pas dépasser 40 caractères',
			'date_prevu_prod_np.after'=>'la date de passage en production est invalide',
			'nature_client_np.required'=>'veuillez préciser la nature du client',
			'chef_projet_np.required'=>'veuillez préciser le chef du projet',
			'chef_projet_np.regex'=>'Le nom du chef du projet n\'est pas valide',
			'email_chef_projet_np.required'=>'veuillez préciser l\'email du chef du projet',
			'email_chef_projet_np.email'=>'l\'email du chef du projet n\'est pas valide',
			'email_chef_projet_np.min'=>'l\'email du chef du projet n\'est pas valide',
			'email_chef_projet_np.max'=>'l\'email du chef du projet ne doit pas dépasser 60 caractères',
			'documentation_np.mimes'=>'La documentation n\'est pas de type valide', 
			'type_app_np.required'=>'veuillez préciser le type de l\'application',
			'date_prevu_prod_np.required'=>'veuillez préciser la date prévue pour le passage en production',
			'date_prevu_prod_np.date'=>' la date prévue pour le passage en production n\'est pas valide',
			'nom_app_np.required'=>'veuillez préciser le nom de l\'application',
			'nom_app_np.regex'=>'le nom de l\'application n\'est pas valide',
			'autre_tech.regex'=>'Autres technologies n\'est pas valide'

		]
		);
		$extension=array('pdf','doc','docx','ppt','pptx');
		if ($file=$request->file('documentation_np')){
		 	if (!in_array($file->getClientOriginalExtension(),$extension))
		 		return back()->withErrors('fichier de type invalide');
		 }
		
		//créer une application associé à la demande non planifiée/
		$app=Application::create([
			'nom'=>request('nom_app_np'),
			'client'=>$client,
			'nature_client'=>request('nature_client_np'),
			'chef_projet'=>request('chef_projet_np'),
			'email_chef_projet'=>request('email_chef_projet_np'),
			'date_prevu_prod'=>request('date_prevu_prod_np'),
			'type_id'=>request('type_app_np'),
			'prevision'=>'NP',
			'plan_id'=>$plan->id,
			'version'=>request('version_np'),
			'autre_tech'=>request('autre_tech')
			
		]);
		
		if($file=$request->file('documentation_np')){
			\Storage::disk('documentations')->put($file->getClientOriginalName(), file_get_contents($file -> getRealPath()));
			
			$app->update(['documentation'=>$file->getClientOriginalName()]);
			
		}
		
		$projet=Projet::create([
			'etat'=>'reçu',
			'application_id'=>$app->id,
			'plan_id'=>$plan->id,
			'date_reception'=> \Carbon\Carbon::now()
		]);

		if($techs= request('tech_np')){
			foreach ($techs as $tech=>$value) {
				
				$app->technologies()->attach($value);
			}
		}
		$role=Role::where('designation','=','admin')->first();
		$users =User::where('role_id','=',$role->id)->get();
		foreach ($users as $user) {
			\Mail::send('emails.demandeSent', ['user' => $user], function ($message) use ($user)
        {

            $message->from('planaudit@elit.dz', 'Plan Audit');

            $message->to($user->email);

            $message->subject("Demande d'audit");

        });
		}
		if (auth()->check()) {
				return view('demands.create_NP2',compact('app'));
			}
			else{
				return view('Client.demands.create_NP2',compact('app'));
			}
		
	}

	public function storeNPStep2()
	{
		$app=Application::find(request('app_id'));
		$app->projets->first()->delete();
		$app->delete();
		if (auth()->check()) {
				return redirect('/demandes/');
			}
			else{
				return redirect('/Client_demandes_NP');
			}
		
	}


	public function index()
	{
		$demandes=Projet::all();
	if ($id= request('plan')){
			$plan=Plan::find($id);
			$demandes=$plan->projets;
			
		}
		else{
			$plan=Plan::where('actuel',1)->first();
			if (!$plan)
			return view('errors.vide');
			$demandes=$demandes->where('plan_id',$plan->id)->sortByDesc('created_at');
			
		}
		
		return view('demands.show',compact('demandes'));
	}
	public function showDemande($id)
	{
		$demande=Projet::find($id);
		return view('demands.showOne',compact('demande'));
	}

	public function supprimerDemande(Request $request)
	{
		$demande=Projet::find(request('id'));
		if ($demande->etat==='reçu'){
			if ($demande->prevision=='NP')
				$demande->application->delete();
			$demande->delete();
			
			return redirect('/demandes');
		}
		else{
			return back()->with('demandeError','impossible');
		}
	}

	public function getApps(Request $request)
	{
		$output='<option selected value="-1"></option>';
		$apps=\DB::table('applications')->where('client','=',$request->client)->where('isValid','=',true)->where('chef_projet','=',null)->get();
		 foreach ($apps as $app) {
		 	$output.='<option value="'.$app->id.'">'.$app->nom.'</option>';

		 }
		 return Response($output);
	}
	public function getClients(Request $request)
	{
		$output='<option selected value="-1"></option>';
		$apps=Application::where('nature_client','=',$request->nature_client)->pluck('client')->unique()->values();
		foreach ($apps as $app) {
		 	$output.='<option>'.$app.'</option>';

		 }
		 return Response($output);

	}
	public function editDemande($id)
	{
		$types=Type::all();
		$demande=Projet::find($id);
		return view('demands.update',compact('demande','types'));
	}
	public function updateDemande($id, Request $request)
	{
		
		$demande=Projet::find($id);
		$this->validate(request(),[
			'chef_projet'=>'bail|required|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/',
			'email_chef_projet'=>'bail|required|email|min:2|max:60',
			'type_app'=>'bail|required|regex:/^[a-zA-Z0-9\séàèôûêç’\']+$/',
			'documentation'=>'bail|mimes:pdf,doc,docx,ppt,pptx'
			
		],[
			'chef_projet.required'=>'veuillez préciser le chef du projet',
			'chef_projet.regex'=>'Le nom du chef du projet n\'est pas valide',
			'email_chef_projet.required'=>'veuillez préciser l\'email du chef du projet',
			'email_chef_projet.email'=>'l\'email du chef du projet n\'est pas valide',
			'email_chef_projet.min'=>'l\'email du chef du projet n\'est pas valide',
			'email_chef_projet.max'=>'l\'email du chef du projet ne doit pas dépasser 60 caractères',
			'documentation.mimes'=>'La documentation n\'est pas de type valide', 
			'type_app.required'=>'veuillez préciser le type de l\'application'

		]
		);
		$extension=array('pdf','doc','docx','ppt','pptx');
		
		$app=$demande->application;
		if ($file=$request->file('documentation'))
		{
			if (!in_array($file->getClientOriginalExtension(),$extension))
		 		return back()->withErrors('fichier de type invalide');
			\Storage::disk('documentations')->put($file->getClientOriginalName(), file_get_contents($file -> getRealPath()));
			
			$app->update(['documentation'=>$file->getClientOriginalName()]);
		}
		
		

		$app->update([
			'nom'=>request('nom_app'),
			'chef_projet'=>request('chef_projet'),
			'email_chef_projet'=>request('email_chef_projet'),
			'version'=>request('version'),
			'type_id'=>request('type_app')
	
		]);
		return redirect('/demandes/'.$demande->id);

		
	}
	public function validateDemande($id)
	{
		$demande=Projet::find($id);
		$demande->update(['isValid'=>true]);
		return redirect('/demandes');
	}
	public function valideDemands()
	{
		if ($id= request('plan')){
			$plan=Plan::find($id);
			$demandes=$plan->projets->where('isValid', 1)->sortByDesc('date_reception');;
			
		}
		else{
			$plan=Plan::where('actuel',1)->first();
			$demandes=$plan->projets->where('plan_id',$plan->id)->where('isValid', 1)->sortByDesc('date_reception');
			
		}
		if (!$plan)
			return view('errors.vide');
		
		return view('demands.show',compact('demandes'));
	}
	public function invalideDemands()
	{
		if ($id= request('plan')){
			$plan=Plan::find($id);
			$demandes=$plan->projets->where('isValid', 0)->sortByDesc('date_reception');
			return view('demands.show',compact('demandes'));

			
		}
		else{
			$plan=Plan::where('actuel',1)->first();
			$demandes=$plan->projets->where('isValid', 0)->sortByDesc('date_reception');
			return view('demands.show',compact('demandes'));

			
		}
			return view('errors.vide');

	}

	function getDocumentation($id)
        {
                $app=Application::find($id);
                $path=storage_path('documents') . ("/documentations/").$app->documentation;
                return response()->file($path);
        }

	
}





























