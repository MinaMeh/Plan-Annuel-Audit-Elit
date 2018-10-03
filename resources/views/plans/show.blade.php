
@extends ('layouts.master')
@section('content')
@include('errors.bddErrors')

<div class="row">                                        
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="font-weight-bold"> Liste des Plans</h4>
        <div class="row purchace-popup">
          <div class="col-12">
            <span class="d-block d-md-flex align-items-center">
              <a class="btn ml-auto download-button d-none d-md-block" href="/plans/create"><i class="mdi mdi-calendar-plus"></i> Ajouter un plan</a>
            
              <a class="btn  btn-dark  mt-4 mt-md-0" data-toggle="modal" data-target="#sendMail" ><i class="mdi mdi-send" ></i>  Envoyer un E-mail</a>
            </span>
            @include('popups.emails.sendMail')
          </div>
        </div>
        <div class="line"></div>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead >
              <tr>  
                <th class="text-center font-weight-bold"> Année</th>
                <th class="text-center font-weight-bold"> Nom du plan</th>
                <th class="text-center font-weight-bold"> Note</th>
                <th class="text-center font-weight-bold"> Réponses</th>
                <th class="text-center font-weight-bold"> Demandes</th>
                <th class="text-center font-weight-bold"> Projets</th>
                <th class="text-center font-weight-bold"> Statistiques </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($plans as $plan)
              <tr>
                <td class="text-center"> {{$plan->annee}}</td>
                <td class="text-center">
                  <a href="/plans/modifier/{{$plan->id}}"> {{$plan->nom}}</a> 
                  @if ($plan->actuel) 
                    <span class="badge badge-success">En cours</span>
                  @else
                    <span class="badge badge-danger">Fermé</span>
                  @endif  
                </td>
                <td class="text-center"> <a href="/plans/note/{{$plan->id}}">Note</a></td>
                <td class="text-center"> <a href="/previsions/?plan={{$plan->id}}"> Voir Réponses</a></td>
                <td class="text-center"> <a href="/demandes/?plan={{$plan->id}}"> Voir Demandes</a></td>
                <td class="text-center"> <a href="/projets/?plan={{$plan->id}}"> Voir Projets</a></td>
                <td class="text-center"> <a href="/statistiques/?plan={{$plan->id}}"> Voir statistiques</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>     
</div>
@endsection
