<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Projet;
use App\Procedure;
use App\User;
use App\Plan;
use App\Controle;
use App\Reaudit;
use App\Vulnerabilite;
use \PDF;
class ProjectsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create($id)
    {
    	$users=User::all();
    	$projet=Projet::find($id);
    	$procedures=Procedure::all();
    	return view ('projets.create',compact('projet','procedures','users'));
    }


    public function show()
    {
       

    	$projets=Projet::where('isValid',1);
         if ($id= request('plan')){
            $plan=Plan::find($id);
            $projets=$plan->projets->where('isValid',1);
           $non_reçu=\DB::table('projets')->rightJoin('applications','projets.application_id', '=', 'applications.id')->where('applications.plan_id', '=', $plan->id)->whereNull('projets.id')->get();
          
        }
        else {
            $plan=Plan::where('actuel',1)->first();
            if (!$plan)
            return view('errors.vide');
            $projets=$plan->projets->where('isValid',1);
            $non_reçu=\DB::table('projets')->rightJoin('applications','projets.application_id', '=', 'applications.id')->where('applications.plan_id', '=', $plan->id)->whereNull('projets.id')->get();
          
        }
        if ($trimestre=request('trimestre')){
            $projets=$projets->where('trimestre',((int)$trimestre));
            $non_reçu=null;
        }

    	return view('projets.show',compact('projets','non_reçu'));
    }
    public function store($id)
    {
    	$this->validate(request(),[
    		'procedure'=>'required',
    		'trimestre'=>'required',
    		'date_debut_audit'=>'required|date|after:today'

    	],[
            
            'procedure.required'=>'Veuillez préciser une procédure',
            'trimestre.required'=>'Veuillez préciser le trimestre',
            'date_debut_audit.required'=>'Veuillez préciser la date de début d\'audit',
            'date_debut_audit.after'=>'La date de début d\'audit est invalide'
        ]);

    	$projet=Projet::find($id);
    	$projet->update([
    		'date_debut_audit'=>request('date_debut_audit'),
    		'trimestre'=>request('trimestre'),
    		'procedure_id'=>request('procedure'),
    		'etat'=>'en audit'
    	]);
    	$projet_id=$projet->id;
    	$users=request('user');
		foreach ($users as $user=>$value) {
			
			$projet->users()->attach($value);
		}
        $controles=Controle::all();
        foreach ($controles as $controle) {
            $projet->controles()->attach($controle->id);
        }
        $vulnerabilites=Vulnerabilite::all();
        foreach ($vulnerabilites as $vulnerabilite) {
            $projet->vulnerabilites()->attach($vulnerabilite->id);
        }
		return redirect('/projets');

    }
    public function modifierProjet(Request $request)
    {

        $this->validate(request(),[
            'date_debut_audit'=>'required',
            'date_fin_audit'=>'date|after:date_debut_audit',
            'date_visa_dssd'=>'date|after:date_fin_audit',
            'date_passage_prod'=>'date|after:date_visa_dssd',
             'trimestre'=>'required',
            'etat'=>'required',
            'procedure'=>'required'
        ],[
            
            'date_debut_audit.required'=>'Veuillez préciser la date de début d\'audit',
            'date_fin_audit.after'=>'la date de fin d\'audit est invalide',
            'date_visa_dssd.after'=>'la date de visa DSSD  est invalide',
            'date_passage_prod.after'=>'la date de passage en production est invalide',
            'trimestre.required'=>'Veuillez préciser le trimestre',
            'etat.required'=>'Veuillez préciser l\'état du projet',
            'procedure.required'=>'Veuillez préciserla procedure du projet'
        ]);
        $projet=Projet::find(request('id'));
        $projet->update([
            'date_debut_audit'=>request('date_debut_audit'),
            'date_fin_audit'=>request('date_fin_audit'),
            'trimestre'=>request('trimestre'),
            'date_visa_dssd'=>request('date_visa_dssd'),
            'date_passage_prod'=>request('date_passage_prod'),
            'procedure_id'=>request('procedure'),
            'etat'=>request('etat')
        ]);

        return back();
    }
    public function supprimerProjet($id)
    {

        $projet=Projet::find($id);

        $projet->update([
            'date_debut_audit'=>null,
            'date_fin_audit'=>null,
           'date_visa_dssd'=>null,
           'date_passage_prod'=>null,
            'trimestre'=>null,
            'isValid'=>false,
            'procedure_id'=>null,
            'date_fin_audit'=>null,
            'date_visa_dssd'=>null,
            'etat'=>'reçu'
        ]);
        $projet->users()->detach();
        return redirect('/projets');
    }
    public function projetsEnAudit()
    {

        if ($id= request('plan')){
            $plan=Plan::find($id);
        
          
        }
        else {
            $plan=Plan::where('actuel',1)->first();
            
        }
            $projets=$plan->projets->where('isValid',1)->where('etat','en audit')->sortByDesc('date_reception');

        return view ('projets.show',compact('projets'));
    }
    public function projetsReaudit()
    {

        if ($id= request('plan')){
            $plan=Plan::find($id);
          
          
        }
        else {
            $plan=Plan::where('actuel',1)->first();
            
            
        }
        $projets=$plan->projets->where('isValid',1)->where('etat','en réaudit')->sortByDesc('date_reception');

        return view ('projets.show',compact('projets'));
    }
    public function   projetsClotures  ()
    {
         if ($id= request('plan')){
            $plan=Plan::find($id);
          
          
        }
        else {
            $plan=Plan::where('actuel',1)->first();
           
            
        }
        $projets=$plan->projets->where('isValid',1)->where('etat','cloturé')->sortByDesc('date_reception');

        return view ('projets.show',compact('projets'));
    }
    public function   projetsEnAttente  ()
    {
         if ($id= request('plan')){
            $plan=Plan::find($id);
          
          
        }
        else {
            $plan=Plan::where('actuel',1)->first();
            
        }
            $projets=$plan->projets->where('isValid',1)->where('etat','reçu')->sortByDesc('date_reception');

        return view ('projets.show',compact('projets'));
    }
    public function projetsNonReçu()
    {
        if ($id= request('plan')){
            $plan=Plan::find($id);
             $projets=\DB::table('projets')->rightJoin('applications','projets.application_id', '=', 'applications.id')->where('applications.plan_id', '=', $plan->id)->whereNull('projets.id')->orderBy('applications.created_at','desc')->get();

             //$projets=\DB::table('projets')->rightJoin('applications','applications.id','=','projets.application_id')->where('applications.plan_id','=',$plan)->whereNull('projets.id')->get();
          
          
        }
        else {
            $plan=Plan::where('actuel',1)->first();

            $projets=\DB::table('projets')->rightJoin('applications','projets.application_id', '=', 'applications.id')->where('applications.plan_id', '=', $plan->id)->whereNull('projets.id')->orderBy('applications.created_at','desc')->get();
           // $projets=\DB::table('projets')->rightJoin('applications','applications.id','=','projets.application_id')->where('projets.plan_id','=',$plan->id)->whereNull('projets.id')->get();
            
        }
      
        return view ('projets.test',compact('projets'));
    }
    public function   projetsAttendreVerion  ()
    {
 if ($id= request('plan')){
            $plan=Plan::find($id);
          
          
        }
        else {
            $plan=Plan::where('actuel',1)->first();
            
            
        }    
        $projets=$plan->projets->where('isValid',1)->where('etat','attendre la bonne version')->sortByDesc('date_reception');
            return view ('projets.show',compact('projets'));
    }
    public function   projetsAuditCloture  ()
    {
          if ($id= request('plan')){
            $plan=Plan::find($id);
           
          
        }
        else {
            $plan=Plan::where('actuel',1)->first();
            
        }
         $projets=$plan->projets->where('isValid',1)->where('etat','audit cloturé')->sortByDesc('date_reception');
          
        return view ('projets.show',compact('projets'));
    }
    public function   projetsAnnule  ()
    {
          if ($id= request('plan')){
            $plan=Plan::find($id);
            
          
        }
        else {
            $plan=Plan::where('actuel',1)->first();
            
        }
         $projets=$plan->projets->where('isValid',1)->where('etat','annulé')->sortByDesc('date_reception');

        return view ('projets.show',compact('projets'));
    }
    //afficher le projet ayant l'id @id //
    public function showProjet($id)
    {
        $projet=Projet::find($id);
        $procedures=Procedure::all();
        if ($projet->etat=="cloturé") {
            return view('projets.showOnly',compact('projet','procedures'));
        }
        return view('projets.showOne',compact('projet','procedures'));
    }
    public function cloturerProjet($id)
    {
        $projet=Projet::find($id);
        $this->validate(request(),[
            'date_visa_dssd'=>'required|date|after:date_fin_audit|after:today',
            'date_passage_prod'=>'date|after:date_visa_dssd'
            
        ],[
            
            'date_visa_dssd.required'=>'Veuillez préciser la date de visa DSSD',
            'date_visa_dssd.after'=>'la date de visa DSSD est invalide',
            'date_passage_prod.after'=>'la date de passage en production est invalide'
           
        ]);
        $projet->update([
            'etat'=>'cloturé',
            'date_fin_audit'=>\Carbon\Carbon::now(),
            'date_visa_dssd'=>request('date_visa_dssd'),
            'date_passage_prod'=>request('date_passage_prod')
        ]);
        return redirect('/projets/'.$projet->id);
    }


    function addProjetReaudits(Request $request)
    {
        if ($request->ajax()){
            Reaudit::create([
                'numero'=>request('numero'),
                'date_debut'=>request('date_debut'),
                'date_fin'=>request('date_fin'),
                'projet_id'=>request('projet_id')
               
            ]);
                        
        }   
    }
    function showProjetReaudits()
    {
        $reaudits=Projet::find(request('projet_id'))->reaudits;
        $output='';
       
            foreach ($reaudits as $reaudit) {
                $output.='<tr>
                         <td class="  text-center  "><input type="text"  class="form-control numero" data-id1="'.$reaudit->id.'" name="numero" value="'.$reaudit->numero.'"></td>
                        <td class=" text-center"  > <input type="date" name="date_debut" class="form-control date_debut" value="'.$reaudit->date_debut.'"data-id2="'.$reaudit->id.'">
                                </td>
                            <td class=" text-center"  >
                                <input type="date" class="form-control date_fin" name="date_fin" value="'.$reaudit->date_fin.'"data-id3="'.$reaudit->id.'"></td>
                                 <td class="text-center" data-id4="'.$reaudit->id.'""> <button type="button" class="btn btn-danger btn-sm btn_delete_re" name="btn_delete" id="btn_delete_re" data-id4="'.$reaudit->id.'"
                                ><span class="fa fa-minus-circle"></button></td>
                              </tr>';
            }
       
        $output.='  <tr contenteditable>
                    <td   ><input id="numero" type="text" class="form-control " name="numero" "></td>
                    <td  ><input id="date_debut" class="form-control " type="date" name="date_debut" value=""></td>
                    <td ><input id="date_fin" class="form-control " type="date" name="date_debut" value=""></td>                   
                    <td width="50"><button type="button" name="btn_add" class="btn btn-success btn-sm" id="btn-info"  onclick="addProjetReaudit($('."'#projet_id'".').val())"><span class="fa fa-plus-circle"></span></button></td>

                </tr>';
        return Response($output);
    }
      public function updateProjetReaudit(Request $request)
    {
        $reaudit=Reaudit::find(request('id'));
        $reaudit->update([request('colomn')=>request('val')]);
        return Response([request('colomn').'=>'.request('val')]);
    }
    public function deleteProjetReaudit(Request $request)
    {
        $reaudit=Reaudit::find(request('id'));
        $reaudit->delete();
    }
    
}
    