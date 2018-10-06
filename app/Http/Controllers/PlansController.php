<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
use App\Plan;

class PlansController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->except('getNote');
	}
	public function create()
	{
		return view('plans.create');
	}
	public function store(Request $request)
	{
		//tous les plans deviennent fermé/
		\DB::update('update plans SET actuel=false');
		    $this->validate(request(),[
			'nom'=>'required|regex:/^[a-zA-Z0-9\s]+$/|min:4|max:30',
			'annee'=>"required|numeric|min:".(\Carbon\Carbon::now()->year-1)."|max:".(\Carbon\Carbon::now()->year+2),
			'note'=>'mimes:pdf'
			
		],[
			'nom.required'=>'veuillez préciser le nom du plan',
			'nom.regex'=>'le nom du plan n\'est pas valide',
			'nom.min'=>'le nom du plan doit dépasser 4 caractères',
			'nom.max'=>'le nom du plan ne doit pas dépasser 30 caractères',
			'annee.required'=>'veuillez préciser l\'année du plan',
			'annee.min'=>'l\'année du plan est invalide',
                        'annee.max'=>'l\'année du plan est invalide',

			'note.mimes'=>'le type du fichier n\'est pas valide'
		]);
		 if ($file=$request->file('note')){

		 	if ($file->getClientOriginalExtension()!='pdf')
		 		return back()->withErrors('fichier de type invalide');
		 }

		 //créer un nv plan//   
		$plan=Plan::create ([
			'nom'=>request('nom'),
			'annee'=>request('annee')
			
					]);
		if ($file=$request->file('note'))
		{

			\Storage::disk('notes')->put($file->getClientOriginalName(), file_get_contents($file -> getRealPath()));
			
			$plan->update(['note'=>$file->getClientOriginalName()]);
		}
		 return redirect('/plans');


	}
	public function show()
	{
		$plans=Plan::all()->sortByDesc('created_at');
		return view('plans.show',compact('plans'));
	}
	public function editPlan($id)
	{
		$plan=Plan::find($id);
		return view("plans.update",compact('plan'));
	}
	public function updatePlan($id, Request $request)
	{
		$plan=Plan::find($id);
		
		 $this->validate(request(),[
			'nom'=>'required|regex:/^[a-zA-Z0-9\s]+$/|min:4|max:30',
                        'annee.required'=>'veuillez préciser l\'année du plan',
                        'annee'=>"required|numeric|min:".(\Carbon\Carbon::now()->year-1)."|max:".(\Carbon\Carbon::now()->year+2),

			'note'=>'mimes:pdf'
		
		],[
			'nom.required'=>'veuillez préciser le nom du plan',
			'nom.regex'=>'le nom du plan n\'est pas valide',
			'nom.min'=>'le nom du plan doit dépasser 4 caractères',
			'nom.max'=>'le nom du plan ne doit pas dépasser 30 caractères',
			'annee.required'=>'veuillez préciser l\'année du plan',
			 'annee.min'=>'l\'année du plan est invalide',
                        'annee.max'=>'l\'année du plan est invalide',

			'note.mimes'=>'le type du fichier n\'est pas valide'
		]);

		if ($file=$request->file('note'))
		{
			if ($file->getClientOriginalExtension()!='pdf')
		 		return back()->withErrors('fichier de type invalide');
			\Storage::disk('notes')->put($file->getClientOriginalName(), file_get_contents($file -> getRealPath()));
			
			$plan->update(['note'=>$file->getClientOriginalName()]);
		}
		$plan->update([
			'nom'=>request('nom'),
			'annee'=>request('annee'),
		]);
		//si  on définit le plan comme actuel les autres deviennent fermé
		if (request('actuel')){
			\DB::update('update plans SET actuel=false');
			$plan->update(['actuel'=>true]);

		}
		else {
			$plan->update(['actuel'=>false]);
		}

		return redirect('/plans');
	}
	public function closePlan($id)
	{
		$plan=Plan::find($id);
		$plan->update([
			'actuel'=>false
		]);
		
		return redirect('/plans');
	}
	public function deletePlan($id)
	{
		$plan=Plan::find($id);

		if ($plan->applications->first())
			return view('errors.404');
		else
		
			{
				$plan->delete();
				return redirect('/plans');
			}

		
	}
	public function sendMail(Request $request)
	{
		$this->validate(request(),[
			'to'=>'required',
			
		]);
		$to=explode(',',request('to'));
		$objet=request('title');
		$file=$request->file('note');
		$body=request('body');


		try {
			    \Mail::send([], ['to'=>$to,'objet'=>$objet,'file'=>$file,'body'=>$body], function ($message) use ($to,$objet,$file,$body)
		        {

		            $message->from("test@email.com", "test");
		            $message->setBody($body);
		            $message->to($to);
		            $message->subject($objet);
		            if($file)
					$message->attach($file->getRealPath(), [ 'mime' =>$file->getClientMimeType()]);

		        });
			    return redirect('/plans')->with('success','success');
			} catch (Exception $ex) {
			    
			    return redirect('/plans')->with('error','error');
			}

					
		
	}
	function getNote($id)
	{
		$plan=Plan::find($id);
		$path=storage_path('documents') . ("/notes/").$plan->note;
		return response()->file($path);
	}
	
}

