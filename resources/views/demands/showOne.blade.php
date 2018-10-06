@extends('layouts.master')
@section('content')
@include ('errors.bddErrors')
<div class="row">                                        
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row" >
          <h4 class="font-weight-bold"> Nom de l'application :  {{$demande->application->nom}}</h4>
        </div>
        @if ($demande->date_debut_audit)
          <span class="badge badge-success">Projet planifié</span>
        @endif 
        @if ($demande->isValid and !$demande->date_debut_audit)
          <div class=" col-md-3 offset-md-9"> 
            <a class="btn btn-inverse-primary" href="/projets/create/{{$demande->id}}"><i class="mdi mdi-ray-start-arrow"></i> Commencer le projet</a>
          </div>
        @endif
        <div class="line"></div><br>
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr>  
              <th class="text-center font-weight-bold"> Nature du client</th>
              <td class="text-center"> {{ $demande->application->nature_client}}</td>
            </tr>
            <tr> 
              <th class="text-center font-weight-bold"> Client</th>
              <td class="text-center">{{ $demande->application->client}}</td>
            </tr>
            <tr> 
              <th class="text-center font-weight-bold"> Date de réception</th>
              <td class="text-center">{{ $demande->date_reception}}</td>
            </tr>
            <tr> 
              <th class="text-center font-weight-bold"> Date Prévu pour passage en production</th>
              <td class="text-center">{{$demande->application->date_prevu_prod}}</td>
            </tr>
            <tr> 
              <th class="text-center font-weight-bold"> Technologies utilisées</th>
              <td class="text-center">
                  @foreach ($demande->application->technologies as $tech)
                    <span class="badge badge-info ">{{$tech->designation}}</span>
                  @endforeach
                  @if ($demande->application->autre_tech)
                      <span class="badge badge-info ">{{$demande->application->autre_tech}}</span>

                  @endif
              </td>
            </tr>
            <tr> 
              <th class="text-center font-weight-bold"> Etat</th>
              <td class="text-center">
                @if ($demande->isValid)  {{'Validée'}}
                @else                    {{'Non validée'}}
                @endif
              </td>
            </tr>
            <tr> 
              <th class="text-center font-weight-bold"> Chef du projet</th>
              <td class="text-center">{{ $demande->application->chef_projet}}</td>
            </tr>
            <tr> 
              <th class="text-center font-weight-bold"> Chef du projet -Email-</th>
              <td class="text-center">{{ $demande->application->email_chef_projet}}</td>
            </tr>
            <tr> 
              <th class="text-center font-weight-bold"> Type de l'application</th>
              <td class="text-center">{{ $demande->application->type->designation}}</td>
            </tr>
            <tr> 
              <th class="text-center font-weight-bold"> Version de l'application</th>
              <td class="text-center">{{ $demande->application->version}}</td>
            </tr>
            <tr> 
              <th class="text-center font-weight-bold"> Documentation de l'application</th>
		@if ($demande->application->documentation)
              <td class="text-center"><a href="/demandes/documentations/{{$demande->application->id}}">Documentation</a></td>
		@endif
            </tr>
          </table> 
        </div>
        <div class="line"></div>
          <h4 class="font-weight-bold">Liste des serveurs </h4> 
        <div class="table-responsive">
           @if ($demande->application->serveurs->first())
          <table class="table table-bordered">
            <thead>
              <th class="text-center font-weight-bold"> Adrsse IP</th>
               <th class="text-center font-weight-bold"> Port</th>
              <th class="text-center font-weight-bold"> Utilisateur</th>
              <th class="text-center font-weight-bold"> Mot de passe</th>
              <th class="text-center font-weight-bold"> Utilisateur SSH</th>
              <th class="text-center font-weight-bold"> Mot de passe SSH</th>
              <th class="text-center font-weight-bold"> Technologie</th>
            </thead>
            <tbody>
              @foreach($demande->application->serveurs as $serveur)
                <tr>
                  <td class="text-center">{{$serveur->addresse_ip}} </td>
                   <td class="text-center">{{$serveur->port}} </td>

                  <td class="text-center">{{$serveur->user}} </td>
                  <td class="text-center">{{$serveur->password}} </td>
                  <td class="text-center">{{$serveur->user_ssh}} </td>
                  <td class="text-center">{{$serveur->password_ssh}} </td>
                  <td class="text-center">{{$serveur->tech}} </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          @else
            <h5 class="font-weight-bold text-danger text-center"> Aucun serveur</h5>
          @endif
        </div> 
        <div class="line"></div>
          <h4 class="font-weight-bold"> Liste des utilisateurs :</h4> 
        <div class="table-responsive">
          @if ($demande->application->appusers->first())
          <table class="table table-bordered">
            <thead>
              <th class="text-center font-weight-bold"> Utilisateur</th>
              <th class="text-center font-weight-bold"> Mot de passe</th>
              <th class="text-center font-weight-bold"> Rôle</th>
            </thead>
            <tbody>
              @foreach($demande->application->appusers as $appuser)
                <tr>
                  <td class="text-center">{{$appuser->username}} </td>
                  <td class="text-center">{{$appuser->password}}</td>
                  <td class="text-center">{{$appuser->role}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
         @else
          <h5 class="font-weight-bold text-danger text-center"> Aucun utilisateur</h5>
          @endif
        </div><br>  
        <div class="row"> 
          @if (!$demande->isValid)
            <div class="col-md-1 offset-md-1 ">
              <a class="btn btn-success  btn-sm" href="/demandes/valider/{{$demande->id}}"><i class="mdi mdi-check"></i> Valider</a>
            </div>
          @endif
          <div class="col-md-1 offset-md-1">
            <a class="btn btn-dark btn-sm " href="/demandes/modifier/{{$demande->id}}"><i class="mdi mdi-cloud-download"></i> Modifier</a>
          </div> 
          <div class="col-md-3 offset-md-1">
            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteDemande" data-id="{{$demande->id}}" href=""><i class="mdi mdi-delete"></i> Supprimer</a>    
          </div>
          @include('popups.demandes.deleteDemande')
        </div>
      </div>
    </div>
  </div>     
</div>    
<script type="text/javascript">
   $('#deletePrevision').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) ;
 // console.log('hello');
  var id= button.data('id'); 

 // console.log(designation);
  var modal = $(this);
  
  modal.find('.modal-body #prevision_id').val(id);
});
</script>                
@endsection
