<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Charts;
use App\Plan;
use App\Projet;
use App\Application;
use \PDF;
class StatsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
    public function index()
    {
    	if(request('plan'))
    	{
    		$plan=request('plan');
    	}
    	else {
    		$plan=Plan::where('actuel',true)->first();
         $plan=$plan->id;
    	}
      if (!$plan)
          return view('errors.vide');
     
    	//Répartition par plan
    	$planStat=$this->planStats()->get();
    	$planChart=$this->planChart();
    	//Répartition des applications selon les technologies
    	$technologies=$this->technologiesStats($plan)->get();
		$technologiesChart=$this->technologiesChart($plan);
    $autre=$this->autreTech($plan);
    	
    	//Répartition des projets selon l'état
    	$etat=$this->etatStats($plan)->get();
    	$etatChart=$this->etatChart($plan);

    	//Répartition des projets selon les procédure
    	$procedure=$this->procedureStats($plan)->get();
    	$procedureChart=$this->procedureChart($plan);


    	//Répartition des projets selon les prévisions
    	$prevision=$this->previsionStats($plan)->get();
    	$previsionChart=$this->previsionChart($plan);


    	//Répartition des projets par prevision/etat

    	$prevision_etat=$this->previsionEtatStats($plan);
    	$prevision_etatChart=$this->previsionEtatChart($plan);
   		
   		//Répartition par type d'application
    	$type=$this->typeStats($plan)->get();
    	$typeChart=$this->typeChart($plan);

    	//Nombre de vulnérabilités
    	$vuln=$this->vulnStats($plan);
    	$vulnChart=$this->vulnChart($plan);


    	//Nombre de vulnérabilités par controle
    	$controle=$this->controleStats($plan)->get();
    	$controleChart=$this->controleChart($plan);



      //nombre de projets par trimestre
      $trimestre=$this->trimestreStats($plan)->get();
      $trimestreChart=$this->trimestreChart($plan);


    	$nbr_projets_prev=Application::where('plan_id',$plan)->where('prevision','PA')->count();
    	$nbr_demandes=Projet::where('plan_id',$plan)->count();
    	$nbr_projets_encours=Projet::where('plan_id',$plan)->where('etat','=','en audit')->orWhere('etat','=','en réaudit')->orWhere('etat','=','audit cloturé')->orWhere('etat','=','attendre la bonne version')->count();

    	return view('statistiques.index',compact('technologies','etat','procedure','prevision','prevision_etat','technologiesChart','etatChart','procedureChart','previsionChart','prevision_etatChart','type','typeChart','vuln','vulnChart','planStat','planChart','nbr_projets_encours','nbr_projets_prev','nbr_demandes','controle','controleChart','trimestre','trimestreChart','autre'));
    
    
   
    }

    private function technologiesStats($plan){

    	$technologies=\DB::table('application_technologie')->join('technologies', 'application_technologie.technologie_id', '=', 'technologies.id')->join('applications','application_technologie.application_id','=','applications.id')->where('plan_id',$plan)->select(\DB::raw('designation, count(*) as nbr_apps' ))->groupBy('designation')->orderBy('nbr_apps','desc	');

    	return ($technologies);
    }
    private function autreTech($plan)
    {
      $autre=Application::where('plan_id','=',$plan)->where('autre_tech','<>','')->whereNotNull('autre_tech')->count();
      return $autre;

    }
    private function technologiesChart($plan)
    {
    	$technologies=$this->technologiesStats($plan);
      $autre=$this->autreTech($plan);
      $designation=$technologies->pluck('designation');
      $designation[]='autre';
      $nbr_apps=$technologies->pluck('nbr_apps');
      $nbr_apps[]=$autre;
    	$chart = Charts::create('pie', 'highcharts')
    	->setColors(['#C5CAE9', '#283593'])
			->setTitle('Répartition des applications selon les technologies')
			->setLabels($designation)
			->setValues($nbr_apps) 
			->setDimensions(1000,500)

			->setResponsive(true);
    	return ($chart);

    }
   private function etatStats($plan)
   {
   	


    $etat=\DB::table('projets')->rightJoin('applications','applications.id','=','projets.application_id')->where('applications.plan_id','=',$plan)->select(\DB::raw('IFNULL(etat, "non reçu") as etat, count(*) as nbr_apps' ))->groupBy('etat');
   	return $etat;
   }
   private function etatChart($plan)
   {
		$etat=$this->etatStats($plan);
		$chart = Charts::create('pie', 'highcharts')
			->setTitle('Répartition des projets par état')
			->setLabels($etat->pluck('etat'))
			->setValues($etat->pluck('nbr_apps'))
			->setDimensions(1000,500)

			->setResponsive(true);
    	return ($chart);

   }
   private function procedureStats($plan)
   {
   		$procedure=\DB::table('projets')->join('procedures','projets.procedure_id','=','procedures.id')->where('projets.plan_id','=',$plan)->select(\DB::raw('designation,code, count(*) as nbr_apps' ))->groupBy('designation')->orderBy('nbr_apps','desc	');
   		return $procedure;
   }
   private function procedureChart($plan)
   {
   		$procedure=$this->procedureStats($plan);
   		$chart = Charts::create('pie', 'highcharts')
			->setTitle('Répartition des projets par procédure')
			->setLabels($procedure->pluck('code'))
			->setValues($procedure->pluck('nbr_apps'))
			->setDimensions(1000,500)

			->setResponsive(true);
    	return ($chart);

   }
   private function previsionStats($plan)
   {
   		$prevision=\DB::table('applications')->join('projets','projets.application_id','=','applications.id')->where('projets.plan_id',"=",$plan)->select(\DB::raw('prevision, count(*) as nbr_apps' ))->groupBy('prevision');
   		return $prevision;
   }
   private function previsionChart($plan)
   {
   		$prevision=$this->previsionStats($plan);
   		$chart = Charts::create('donut', 'highcharts')
			->setTitle('Répartition des projets par prévisions')
			->setLabels($prevision->pluck('prevision'))
			->setValues($prevision->pluck('nbr_apps'))
			->setDimensions(1000,500)

			->setResponsive(true);
    	return ($chart);

   }
   private function typeStats($plan)
   {
   		$type=\DB::table('applications')->join('types','applications.type_id','=','types.id')->where('applications.plan_id','=',$plan)->select(\DB::raw('designation, count(*) as nbr_apps' ))->groupBy('designation')->orderBy('nbr_apps','desc	');
   		return $type;
   }
   private function typeChart($plan)
   {
   		$type=$this->typeStats($plan);
   		$chart = Charts::create('donut', 'highcharts')
			->setTitle('Répartition des projets par type d\'application')
			->setLabels($type->pluck('designation'))
			->setValues($type->pluck('nbr_apps'))
			->setDimensions(1000,500)

			->setResponsive(true);
    	return ($chart);

   }
   private function previsionEtatStats($plan)
   {
      $table_PA=\DB::table('projets')->rightJoin('applications','applications.id','=','projets.application_id')->where('projets.plan_id','=',$plan)->where('prevision','PA');
      $PA_fait=$table_PA->where('etat','=','cloturé')->count();
      $table_PA=\DB::table('projets')->rightJoin('applications','applications.id','=','projets.application_id')->where('projets.plan_id','=',$plan)->where('prevision','PA');

      $PA_encours=$table_PA->where('etat','=','en audit')->where('etat','=','en réaudit')->orWhere('etat','=','audit cloturé')->orWhere('etat','=','attendre la bonne version')->count();
      $table_PA=\DB::table('projets')->rightJoin('applications','applications.id','=','projets.application_id')->where('projets.plan_id','=',$plan)->where('prevision','PA');

      $PA_nonFait=$table_PA->count()-$PA_encours-$PA_fait;
      $table_NP=\DB::table('projets')->rightJoin('applications','applications.id','=','projets.application_id')->where('projets.plan_id','=',$plan)->where('prevision','NP');
      $NP_fait=$table_NP->where('etat','=','colturé')->count();
      $table_NP=\DB::table('projets')->rightJoin('applications','applications.id','=','projets.application_id')->where('projets.plan_id','=',$plan)->where('prevision','NP');

      $NP_encours=$table_NP->where('etat','=','en audit')->where('etat','=','en réaudit')->orWhere('etat','=','audit cloturé')->orWhere('etat','=','attendre la bonne version')->count();
       $table_NP=\DB::table('projets')->rightJoin('applications','applications.id','=','projets.application_id')->where('projets.plan_id','=',$plan)->where('prevision','NP');
  
      $NP_nonFait=$table_NP->count()-$NP_fait-$NP_encours;

   //		$prevision_etat=\DB::table('Projets')->rightJoin('applications','applications.id','=','projets.application_id')->where('projets.plan_id','=',$plan)->select(\DB::raw('IFNULL(etat, "non reçu") as etat,prevision, count(*) as nbr_apps' ))->groupBy('prevision','etat');
      $prevision_etat = [
          'PA_fait' => $PA_fait,
          'PA_encours'=>$PA_encours,
          'PA_nonFait'=>$PA_nonFait,
          'NP_encours'=>$NP_encours,
          'NP_fait'=>$NP_fait,
          'NP_nonFait'=>$NP_nonFait
      ];
   		return $prevision_etat;
   }
   private function previsionEtatChart($plan)
   {
   		
   		$prevision_etat=$this->previsionEtatStats($plan);
   		$chart = Charts::multi('bar', 'highcharts')
			->setTitle('Répartition des projets par prévision/état')
			->setLabels(['NP','PA'])
			->setDataset('Fait',[$prevision_etat['NP_fait'],$prevision_etat['PA_fait']])
		    ->setDataset('Non fait',[$prevision_etat['NP_nonFait'],$prevision_etat['PA_nonFait']])
		    ->setDataset('En cours',[$prevision_etat['NP_encours'],$prevision_etat['PA_encours']])

			->setDimensions(1000,500)

			->setResponsive(true);




    	return ($chart);

   }
   private function vulnStats($plan)
   {
		$vuln_faibles=Projet::where('plan_id',$plan)->sum('vuln_faibles');   	
		$vuln_moyennes=Projet::where('plan_id',$plan)->sum('vuln_moyennes');   	
		$vuln_eleves=Projet::where('plan_id',$plan)->sum('vuln_eleves');   	
		return [$vuln_faibles,$vuln_moyennes,$vuln_eleves];
   }
   private function vulnChart($plan)
   {
   		$vuln=$this->vulnStats($plan);
   		$chart = Charts::create('bar', 'highcharts')
			->setTitle('Nombre de vulnérabilités')
			->setLabels(['Faibles','Moyennes','Elevées'])
			->setValues([$vuln[0],$vuln[1],$vuln[2]])
			->setDimensions(1000,500)

			->setResponsive(true);
    	return ($chart);
   }
   private function planStats()
   {
   		$plan=\DB::table('projets')->join('plans','projets.plan_id','=','plans.id')->select(\DB::raw('nom, count(*) as nbr_prj' ))->groupBy('nom')->orderBy('nbr_prj','desc	');
   		return $plan;
   }
   private function planChart()
   {
   		$plan=$this->planStats();
   		$chart = Charts::create('line', 'highcharts')
			->setTitle('Répartition des projets par plans')
			->setLabels($plan->pluck('nom'))
			->setValues($plan->pluck('nbr_prj'))
			->setDimensions(1000,500)

			->setResponsive(true);
    	return ($chart);

   }
   private function controleStats($plan)
   {
   	 $controle=\DB::table('controle_projet')->join('controles','controles.id','=','controle_projet.controle_id')->join('projets','projets.id','=','controle_projet.projet_id')->where('projets.plan_id','=',$plan)->select(\DB::raw('projets.id,designation,sum(nbr) as nbr_vul' ))->groupBy('designation')->orderBy('nbr_vul','desc	');
   	 return ($controle);
   }
   private function controleChart($plan)
   {
   		$controle=$this->controleStats($plan);
   		$chart = Charts::create('bar', 'highcharts')
			->setTitle('Nombre de vulnérabilités par controle')
			->setLabels($controle->pluck('designation'))
			->setValues($controle->pluck('nbr_vul'))
			->setDimensions(1000,500)

			->setResponsive(true);
    	return ($chart);

   }
    private function trimestreStats($plan)
   {
     $trimestre=Projet::where('projets.plan_id','=',$plan)->whereNotNull('trimestre')->select(\DB::raw('trimestre,count(*) as nbr_prj' ))->groupBy('trimestre')->orderBy('trimestre');
     return ($trimestre);
   }
    private function trimestreChart($plan)
   {
      $trimestre=$this->trimestreStats($plan);
      $chart = Charts::create('bar', 'highcharts')
      ->setTitle('Nombre de projets par trimestre')
      ->setLabels($trimestre->pluck('trimestre'))
      ->setValues($trimestre->pluck('nbr_prj'))
      ->setDimensions(1000,500)

      ->setResponsive(true);
      return ($chart);

   }
   
}
