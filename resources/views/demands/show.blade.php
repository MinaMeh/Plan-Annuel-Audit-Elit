@extends ('layouts.master')
@section('content')
@include('errors.bddErrors')
<div class="row">                                        
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
          <h4 class="font-weight-bold"> Liste des demandes reçues :</h4> 
       <div class="row purchace-popup">
          <div class="col-12">
            <span class="d-block d-md-flex align-items-center">
              <a class="btn ml-auto download-button d-none d-md-block" href="/demandes/createNP"><i class="mdi mdi-message-plus"></i> Ajouter une demande non planifiée</a>
              <a class="btn download-button mt-4 mt-md-0" href="/demandes/create"><i class="mdi mdi-message-plus"></i> Ajouter une demande planifiée</a>
            </span>
          </div>
        </div>
        <div class="line"></div>
        <div class="btn-group" role="group">
            @if (request('plan'))
              <a  class="btn btn-secondary" href="/demandes?plan={{request('plan')}}" > Toutes</a>
            @else
              <a  class="btn btn-secondary" href="/demandes" > Toutes</a>
            @endif
            @if (request('plan'))
              <a  class="btn btn-secondary" href="/demandes/valides?plan={{request('plan')}}" > Validées</a>
            @else
              <a  class="btn btn-secondary" href="/demandes/valides" > Validées</a>
            @endif
          
            @if (request('plan'))
              <a  class="btn btn-secondary" href="/demandes/invalides?plan={{request('plan')}}" > Non validées</a>
            @else
              <a  class="btn btn-secondary" href="/demandes/invalides" > Non validées</a>
            @endif        
          </div>
        <div class="line"></div>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead >
              <tr>  
                <th class="text-center font-weight-bold" colspan="2"> Nom de l'application</th>
                <th class="text-center font-weight-bold"> Prévision/Priorité</th>
                <th class="text-center font-weight-bold"> Date de réception</th>
                <th class="text-center font-weight-bold"> Nature du client</th>
                <th class="text-center font-weight-bold"> Client</th>
                <th class="text-center font-weight-bold"> Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($demandes as $demande)
              <tr>
                <td class="text-center">
                  <a href="/demandes/{{$demande->id}}">{{$demande->application->nom}}</a>
                </td>
                <td>
                  @if ($demande->isValid)
                  <span class="badge badge-success"><i class="mdi mdi-check"></i> Validée</span>
                  @else
                  <span class="badge badge-danger"><i class="mdi mdi-close"></i> Non validée</span>
                  @endif 
                </td>
                <td>
                  @if ($demande->application->prevision=='PA')
                  <span class="badge badge-warning"><i class="mdi mdi-check"></i> Planifiée</span>
                  @else
                  <span class="badge badge-dark"><i class="mdi mdi-close"></i> Non planifiée</span>
                  @endif 
                </td>
                <td class="text-center">{{$demande->date_reception}}</td>
                <td class="text-center">{{$demande->application->nature_client}}</td>
                <td class="text-center">{{$demande->application->client}}</td>
                
                <td class="text-center"> 
                  @if (!$demande->isValid)
                    <a class="btn btn-inverse-success btn-sm" href="/demandes/valider/{{$demande->id}}"><span class="mdi mdi-check" aria-hidden='true'></span></a>
                  @else
                    <a disabled class="disabled btn btn-inverse-success btn-sm" href="/demande/valider/{{$demande->id}}"><span class="mdi mdi-check" aria-hidden='true'></span></a>
                  @endif
                    <a class="btn btn-inverse-danger btn-sm"  data-toggle="modal" data-target='#deleteDemande' data-id="{{$demande->id}}" href="#"><span class="mdi mdi-delete"></span></a>
                    <a class="btn btn-inverse-primary btn-sm " href="/demandes/modifier/{{$demande->id}}"><span class="mdi mdi-pencil"></span></a>
                </td>
              </tr>
              @endforeach
              @include ("popups.demandes.deleteDemande")
            </tbody>
          </table> 
        </div>
      </div>
    </div>
  </div>     
</div>                
@endsection