@extends('layouts.master')
@section('content')
@include ('errors.bddErrors')
<div class="row">                                        
    <div class="col-lg-12 grid-margin stretch-card">
    	<div class="card">
        	<div class="card-body">
	            <div class="row" >
	            	<h4> Nom de l'application : {{$projet->application->nom}}</h4>
	            	@if ($projet->isValid and !$projet->date_debut_audit)
		              <div class=" col-md-2 offset-md-4"> 
		                  <a class="btn btn-success" href="/projets/create/{{$projet->id}}"><i class="mdi mdi-ray-start-arrow"></i> Commencer le projet</a>
		              </div>
		            @endif
		            @if ($projet->isValid and $projet->date_debut_audit and $projet->etat!='cloturé')
		              <div class=" col-md-2 offset-md-4" > 
		                  <a href="#" class="btn btn-inverse-danger" data-toggle="modal" data-target="#cloturer"><i class="mdi mdi-close" ></i> Cloturer le projet</a>
		              </div>
		              @include ('popups.projets.cloturer')
		            @endif
		        </div>
	            <div class="row">
		           	@if ($projet->date_debut_audit and !$projet->date_fin_audit)
		              <span class="badge badge-info"><i class="mdi mdi-calendar-text"></i> Projet planifié</span>
		            @elseif ($projet->etat=='cloturé')
		              <span class="badge badge-success"><i class="mdi mdi-check"></i> Projet cloturé</span>
		            @endif 
	            </div>
          		<div class="line"></div>
          		<h4 class="font-weight-bold "> Informations sur le projet</h4> <br>
	            <div class="table-responsive">
		            <table class="table table-bordered">
		                <tr>  
		                  <th class="text-center font-weight-bold"> Etat</th>
		                  <td class="text-center"> {{ $projet->etat}}</td>
		                </tr>
		                <tr> 
		                  <th class="text-center font-weight-bold"> Date de réception</th>
		                  <td class="text-center"> {{$projet->date_reception}}</td>
		                </tr>
		                @if ($projet->procedure)
			              <tr> 
			                  <th class="text-center font-weight-bold"> Procédure</th>
			                  <td class="text-center"> {{$projet->procedure->designation}}</td>
			              </tr>
		                @endif
		                <tr> 
		                  <th class="text-center font-weight-bold"> Trimestre</th>
		                  <td class="text-center"> {{$projet->trimestre}}</td>
		                </tr>
		                <tr>
		                	<th class="text-center font-weight-bold"> Pentesters</th>
		                	<td class="text-center">
		                		@foreach ($projet->users as $user)
			                   <span class="badge badge-info">{{$user->name}}</span>
			                 @endforeach
		                	</td>
		                </tr>
		                <tr> 
		                  <th class="text-center font-weight-bold"> Date de début d'audit</th>
		                  <td class="text-center"> {{$projet->date_debut_audit}}</td>
		                </tr>
		                <tr> 
		                  <th class="text-center font-weight-bold"> Date de fin d'audit</th>
		                  <td class="text-center"> {{$projet->date_fin_audit}}</td>
		                </tr>
		                <tr> 
		                  <th class="text-center font-weight-bold"> Date de VISA DSSD</th>
		                  <td class="text-center"> {{$projet->date_visa_dssd}}</td>
		                </tr>
		                 <tr> 
		                  <th class="text-center font-weight-bold"> Date de passage en production</th>
		                  <td class="text-center"> {{$projet->date_passage_prod}}</td>
		                </tr>
		            </table> 
	          	</div>
          		<div class="line"></div>
          		<h4 class="font-weight-bold"> Informations sur l'application</h5><br>
	          	<div class="table-responsive">
		            <table class="table table-bordered">
		                <tr>
		                  <th class="text-center font-weight-bold">Nature client</th>
		                  <td class="text-center"> {{ $projet->application->nature_client}}</td>
		                </tr>
		                <tr>
		                  <th class="text-center font-weight-bold">client</th>
		                  <td class="text-center"> {{ $projet->application->client}}</td>
		                </tr>
		                <tr>
		                  <th class="text-center font-weight-bold">Date de récpetion</th>
		                  <td class="text-center"> {{ $projet->date_reception}}</td>
		                </tr>
		                <tr>
		                  <th class="text-center font-weight-bold">Date Prévu de passage en production</th>
		                  <td class="text-center"> {{$projet->application->date_prevu_prod}}</td>
		                </tr>
		                <tr>
		                  <th class="text-center font-weight-bold"> Technologies utilisées</th>
			              <td class="text-center"> 
			                 @foreach ($projet->application->technologies as $tech)
			                   <span class="badge badge-info">{{$tech->designation}}</span>
			                 @endforeach
			                 @if ($projet->application->autre_tech)
			                 	 <span class="badge badge-info">{{$projet->application->autre_tech}}</span>

			                 @endif
			              </td>
		                </tr>
		                <tr>
		                  <th class="text-center font-weight-bold"> Etat</th>
		                  <td class="text-center"> 
			                  @if ($projet->isValid)   {{'Validée'}}
			                  @else                    {{'Non validée'}}
			                  @endif
		                  </td>
		                </tr>
		                <tr> 
		                  <th class="text-center font-weight-bold"> Chef du projet</th>
		                  <td class="text-center"> {{ $projet->application->chef_projet}}</td>
		                </tr>
		                <tr> 
		                  <th class="text-center font-weight-bold"> Chef du projet -Email-</th>
		                  <td class="text-center"> {{ $projet->application->email_chef_projet}}</td>
		                </tr>
		                <tr> 
		                  <th class="text-center font-weight-bold"> Type de l'application</th>
		                  <td class="text-center"> {{ $projet->application->type->designation}}</td>
		                </tr>
		                <tr> 
		                  <th class="text-center font-weight-bold"> Version de l'application</th>
		                  <td class="text-center"> {{ $projet->application->version}}</td>
		                </tr>
		                <tr> 
		                  <th class="text-center font-weight-bold"> Documentation de l'application</th>
		                  <td class="text-center"><a href="{{$projet->application->documentation}}">{{ 'Documentation_'.$projet->application->nom}}</a></td>
		                </tr>
		            </table> 
	        	</div>
          		<div class="line"></div>
          		<h4 class="font-weight-bold"> Liste des serveurs</h4> <br>
          		<div class="table-responsive">
					@if ($projet->application->serveurs->first())
					<table class="table  table-bordered">
						<thead>
							<th> Adrsse IP</th>
							<th> Utilisateur</th>
							<th> Mot de passe</th>
							<th> Utilisateur SSH</th>
							<th> Mot de passe SSH</th>
							<th> Technologie</th>
						</thead>
						<tbody>
							@foreach($projet->application->serveurs as $serveur)
								<tr>
									<td>{{$serveur->addresse_ip}} </td>
									<td>{{$serveur->user}} </td>
									<td>{{$serveur->password}} </td>
									<td>{{$serveur->user_ssh}} </td>
									<td>{{$serveur->password_ssh}} </td>
									<td>{{$serveur->tech}} </td>
								</tr>
							@endforeach
						</tbody>
					</table>
					@else
						<h5 class="font-weight-bold text-danger"> Aucun serveur</h5>	
					@endif
          		</div> 
	            <div class="line"></div>
	            <h4 class="font-weight-bold "> Liste des utilisateurs</h4> <br>
	            @if ($projet->application->appusers->first())
	            <div class="table-responsive">
		            <table class="table table-bordered">
		              <thead>
		                 <th class="text-center font-weight-bold"> Utilisateur</th>
		                 <th class="text-center font-weight-bold"> Mot de passe</th>
		                 <th class="text-center font-weight-bold"> Rôle</th>
		              </thead>
		              <tbody>
		                  @foreach($projet->application->appusers as $appuser)
		                  <tr>
		                    <td class="text-center">{{$appuser->username}} </td>
		                    <td class="text-center">{{$appuser->password}}</td>
		                    <td class="text-center">{{$appuser->role}}</td>
		                  </tr>
		                @endforeach
		              </tbody>
		            </table>
	            </div>
	            @else
		            <h5 class="font-weight-bold text-danger"> Aucun utilisateur</h5>
		        @endif

		         <div class="line"></div>
		         <div class="col-md-9 ">
		             <input type="" hidden="" id="projet_id" value="{{$projet->id}}" name="">
		                
	            <h4 class="font-weight-bold"> Liste des réaudits</h4> <br>
	           
	            <div class="table-responsive">
		            <table class="table table-bordered">
		              <thead>
		                 <th class=" text-center font-weight-bold" > Numero</th>
		                 <th class=" text-center font-weight-bold"> Date de début</th>
		                 <th class=" text-center font-weight-bold"> Date de fin</th>
			              </thead>

		              <tbody id="projetReaudits">
		              	
		                  @foreach($projet->reaudits as $reaudit)
		                  <tr contenteditable>
		                    <td class="  text-center " >{{$reaudit->numero}}</td>
		                    <td class=" text-center"  "> {{$reaudit->date_debut}}
		                    	</td>
		                    <td class=" text-center"  ">
		                    	{{$reaudit->date_fin}}</td>
		                   
	                       
		                  </tr>

		                @endforeach
		                 
		                 
		              </tbody>
		            </table>
	            </div>
	           </div>
		            <br>
	            <div class="row"> 
		            @if (!$projet->isValid)
		              <div class="col-md-1 offset-md-1 ">
		                  <a class="btn btn-success  btn-sm" href="/projets/valider/{{$projet->id}}"><i class="mdi mdi-check"></i> Valider</a>
		              </div>
		            @endif
		           
	            </div>
            </div>
        </div>
    </div>     
</div>                
@endsection      






