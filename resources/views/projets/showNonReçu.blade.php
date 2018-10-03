@extends ('layouts.master')
@section('content')
<div class="row">                                        
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
          <h4 class="font-weight-bold"> Liste des projets</h4> 
        <div class="line"></div>
        <div class="btn-group" role="group">
          <a  class="btn btn-secondary" href="/projets"> Tous</a>
          <a  class="btn btn-secondary" href="/projets/audit"> En audit</a>
          <a  class="btn btn-secondary" href="/projets/cloturés"> Cloturés</a>
          <a  class="btn btn-secondary" href="/projets/attente"> Reçus</a>
          <a  class="btn btn-secondary" href="/projets/non_reçu"> Non reçus</a>
        </div>
        <div class="line"></div>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead >
              <tr>  
                <th class="text-center font-weight-bold" colspan="2"> Nom de l'application</th>
                <th class="text-center font-weight-bold"> Procédure</th>
                <th class="text-center font-weight-bold"> Date de Réception</th>
                <th class="text-center font-weight-bold"> Date Début d'audit</th>
                <th class="text-center font-weight-bold"> Date fin d'audit</th>
                <th class="text-center font-weight-bold"> Date Visa DSSD</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($projets as $projet)
              <tr>
                <td class="text-center">
                  <a href="/projets/{{$projet->id}}"> {{$projet->nom}}</a>
                </td>
                <td>
                    @if ($projet->etat=='en cours')
                      <span class="badge badge-primary">{{$projet->etat}}</span>
                    @elseif ($projet->etat=='cloturé')
                      <span class="badge badge-success">{{$projet->etat}}</span>
                    @elseif ($projet->etat=='reçu')
                      <span class="badge badge-warning">En attente</span>
                    @else
                      <span class="badge badge-dark">{{$projet->etat}}</span>
                    @endif 
                </td>
                <td class="text-center">
                  @if ($projet->procedure)
                    {{$projet->procedure->designation}}
                  @endif
                </td>
                <td class="text-center">{{$projet->date_reception}}</td>
                <td class="text-center">
                  @if ($projet->date_debut_audit)
                    {{$projet->date_debut_audit}}
                  @else
                    En attente
                  @endif
                </td>
                <td class="text-center"> 
                  @if ($projet->date_fin_audit )
                    {{$projet->date_debut_audit}}
                  @elseif ($projet->date_debut_audit)
                    En cours
                  @else
                     /
                  @endif
                </td>
                <td class="text-center">
                  @if ($projet->date_visa_dssd)
                    {{$projet->date_visa_dssd}}
                  @else
                     /
                  @endif 
                </td>
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