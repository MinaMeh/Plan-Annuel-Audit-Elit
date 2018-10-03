<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

Route::auth();


/****Gestion des plans*****/
Route::get('/plans/create', 'PlansController@create');
Route::get('/plans', 'PlansController@show');
Route::post('/plans/sendMail','PlansController@sendMail');
Route::post('/plans', 'PlansController@store');
Route::get('/plans/supprimer/{plan}', 'PlansController@deletePlan');
Route::get('/plans/modifier/{plan}', 'PlansController@editPlan');
Route::post('/plans/modifier/{plan}', 'PlansController@updatePlan');
Route::get('/plans/cloturer/{plan}', 'PlansController@closePlan');
Route::get('/plans/send/{plan}', 'PlansController@sendMail');
Route::get('/plans/note/{plan}', 'PlansController@getNote');

/****Gestion des prévisions****/
Route::get('/previsions/create', 'PrevisionsController@create');
Route::post('/previsions', 'PrevisionsController@store');
Route::get('/previsions', 'PrevisionsController@index');
Route::get('/previsions/valide', 'PrevisionsController@validePrevisions');
Route::get('/previsions/invalide', 'PrevisionsController@invalidePrevisions');

Route::get('/previsions/{prevision}', 'PrevisionsController@showPrevision');
Route::get('/previsions/valider/{prevision}', 'PrevisionsController@validatePrevision');
Route::post('/previsions/supprimer', 'PrevisionsController@deletePrevision');
Route::get('/previsions/modifier/{prevision}', 'PrevisionsController@editPrevision');
Route::post('/previsions/modifier/{prevision}', 'PrevisionsController@updatePrevision');

/*******Gestion des demandes***************/
Route::get('/demandes/create','DemandsController@create');
Route::get('/demandes/createNP','DemandsController@createNPdemand');
Route::post('/demands/step1', 'DemandsController@store');
Route::post('/demands/step2', 'DemandsController@storeStep2');
Route::get('/demandes','DemandsController@index');

Route::get('/demandes/step2',function () {
    return view('demands.create2');
});


Route::post('/demandsNPStep1','DemandsController@storeNPStep1');
Route::post('/demandsNPStep2','DemandsController@storeNPStep2');
Route::get('/demandes/valides', 'DemandsController@valideDemands');
Route::get('/demandes/invalides', 'DemandsController@invalideDemands');

Route::get('/demandes/{demande}','DemandsController@showDemande');
Route::get('/demandes/modifier/{demande}','DemandsController@editDemande');
Route::get('/demandes/valider/{demande}','DemandsController@validateDemande');
Route::post('/demands/modifier/{demande}','DemandsController@updateDemande');
Route::post('/demandes/supprimer','DemandsController@supprimerDemande');
Route::get('/demandes/documentations/{id}','DemandsController@getDocumentation');

Route::get('/getApps','DemandsController@getApps');
Route::get('/getClients','DemandsController@getClients');
Route::get('/addUserApp','ApplicationsController@addUserApp');
Route::get('/showUserApps','ApplicationsController@showUserApp');
Route::get('/addUserServer','ApplicationsController@addUserServer');
Route::get('/showUserServers','ApplicationsController@showUserServers');
Route::get('/updateAppuser','ApplicationsController@updateAppUser');
Route::get('/deleteAppuser', 'ApplicationsController@deleteAppUser');
Route::get('/deleteAppServer','ApplicationsController@deleteAppServer');
Route::get('/updateAppServer','ApplicationsController@updateAppServer');

/************Gestion des projets**************/
Route::get('/projets/create/{id}','ProjectsController@create');
Route::post('/projet/create/{projet}','ProjectsController@store');
Route::get('/projets','ProjectsController@show');
Route::get('/projets/audit','ProjectsController@projetsEnAudit');
Route::get('/projets/cloturés','ProjectsController@projetsClotures');
Route::get('/projets/attente','ProjectsController@projetsEnAttente');
Route::get('/projets/non_reçu','ProjectsController@projetsNonReçu');
Route::get('/projets/reaudits','ProjectsController@projetsReaudit');
Route::get('/projets/attendre_version','ProjectsController@projetsAttendreVerion');
Route::get('/projets/annulé','ProjectsController@projetsAnnule');
Route::get('/projets/audit_cloturé','ProjectsController@projetsAuditCloture');
Route::post('/projets/cloturer/{projet}','ProjectsController@cloturerProjet');
Route::post('/projets/modifier','ProjectsController@modifierProjet');
Route::get('/projets/supprimer/{projet}','ProjectsController@supprimerProjet');

Route::get('/showProjetReaudits','ProjectsController@showProjetReaudits');
Route::get('/addProjetReaudits','ProjectsController@addProjetReaudits');
Route::get('/updateProjetReaudit','ProjectsController@updateProjetReaudit');
Route::get('/deleteProjetReaudit','ProjectsController@deleteProjetReaudit');
Route::get('/projets/{projet}','ProjectsController@showProjet');

/***********Administration**************/
Route::get('/administration','AdministrationController@show');
Route::post('/technologies','AdministrationController@addTechnologie');
Route::post('/departements','AdministrationController@addDepartement');
Route::post('/procedures','AdministrationController@addProcedure');
Route::post('/types','AdministrationController@addType');
Route::post('/users','AdministrationController@addUser');
Route::post('/controles','AdministrationController@addControle');
Route::post('/vulnerabilites','AdministrationController@addVulnerabilite');

Route::post('/technologies/modifier','AdministrationController@modifierTechnologie');
Route::post('/departements/modifier','AdministrationController@modifierDepartement');
Route::post('/procedures/modifier','AdministrationController@modifierProcedure');
Route::post('/users/modifier','AdministrationController@modifierUser');
Route::post('/types/modifier','AdministrationController@modifierType');
Route::post('/controles/modifier','AdministrationController@modifierControle');
Route::post('/vulnerabilites/modifier','AdministrationController@modifierVulnerabilite');

Route::post('/technologies/supprimer','AdministrationController@supprimerTechnologie');
Route::post('/departements/supprimer','AdministrationController@supprimerDepartement');
Route::post('/procedures/supprimer','AdministrationController@supprimerProcedure');
Route::post('/users/supprimer','AdministrationController@supprimerUser');
Route::post('/types/supprimer','AdministrationController@supprimerType');
Route::post('/controles/supprimer','AdministrationController@supprimerControle');
Route::post('/vulnerabilites/supprimer','AdministrationController@supprimerVulnerabilite');

Route::post('/roles/','AdministrationController@addRole');
Route::get('/statistiques','StatsController@index');

Route::get('/home', 'PlansController@show');


Route::get('/vulnerabilites','ResultsController@showVulnerabilities');
Route::get('/vulnerabilitesTypes','ResultsController@showVulnerabilitiesTypes');

Route::get('/updateVuln','ResultsController@updateVuln');
Route::get('/controles','ResultsController@showControles');
Route::get('/updateProjetControle', 'ResultsController@updateProjetControle');
Route::get('/updateProjetVuln', 'ResultsController@updateProjetVuln');
Route::get('/procedures/fiches/{id}','AdministrationController@getProcedureFiche');
/*************Partie Client************************/

Route::get('/client/',function(){
	 $plan=App\Plan::where('actuel',1)->first();
	 if (!$plan) {
	 	return view('errors.videClient');
	 }
	return view('Client.home');
});
Route::get('/Client_previsions_create', 'PrevisionsController@createClient');
Route::get('/Client_demandes_create', 'DemandsController@createClient');
Route::get('/Client_demandes_NP', 'DemandsController@createNPClient');





/**************************/
