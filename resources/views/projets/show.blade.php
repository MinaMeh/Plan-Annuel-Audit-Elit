@extends ('layouts.master')
@section('content')
<div class="row">                                        
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        
          <h4 class="font-weight-bold"> Liste des projets</h4> 
        <div class="line"></div>
        <div class="btn-group" role="group">
            @if (request('plan'))
              <a  class="btn btn-secondary" href="/projets?plan={{request('plan')}}"> Tous</a>
            @else
              <a  class="btn btn-secondary" href="/projets"> Tous</a>
            @endif
             @if (request('plan'))
              <a  class="btn btn-secondary" href="/projets/audit?plan={{request('plan')}}"> En audit</a>
            @else
              <a  class="btn btn-secondary" href="/projets/audit"> En audit</a>
            @endif
            @if (request('plan'))
              <a  class="btn btn-secondary" href="/projets/cloturés?plan={{request('plan')}}"> Cloturé</a>
            @else
              <a  class="btn btn-secondary" href="/projets/cloturés"> Cloturé</a>
            @endif
            @if (request('plan'))
              <a  class="btn btn-secondary" href="/projets/reaudits?plan={{request('plan')}}"> En réaudit</a>
            @else
              <a  class="btn btn-secondary" href="/projets/reaudits"> En réaudit</a>
            @endif
            @if (request('plan'))
              <a  class="btn btn-secondary" href="/projets/audit_cloturé?plan={{request('plan')}}"> Audit Cloturé</a>
            @else
              <a  class="btn btn-secondary" href="/projets/audit_cloturé"> Audit cloturé</a>
            @endif
            @if (request('plan'))
              <a  class="btn btn-secondary" href="/projets/attente?plan={{request('plan')}}"> Reçus</a>
            @else
              <a  class="btn btn-secondary" href="/projets/attente"> Reçus</a>
            @endif
            @if (request('plan'))
              <a  class="btn btn-secondary" href="/projets/non_reçu?plan={{request('plan')}}"> Non reçus</a>
            @else
              <a  class="btn btn-secondary" href="/projets/non_reçu"> Non reçus</a>
            @endif
            @if (request('plan'))
              <a  class="btn btn-secondary" href="/projets/attendre_version?plan={{request('plan')}}"> Attendre la bonne version</a>
            @else
              <a  class="btn btn-secondary" href="/projets/attendre_version"> Attendre la bonne version</a>
            @endif
            @if (request('plan'))
              <a  class="btn btn-secondary" href="/projets/annulé?plan={{request('plan')}}"> Annulés</a>
            @else
              <a  class="btn btn-secondary" href="/projets/annulé"> Annulés</a>
            @endif
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
                  <a href="/projets/{{$projet->id}}"> {{$projet->application->nom}}</a>
                </td>
                <td>
                  @if ($projet->etat=='en cours')
                    <span class="badge badge-info">{{$projet->etat}}</span>
                  @elseif ($projet->etat=='cloturé')
                    <span class="badge badge-success">{{$projet->etat}}</span>
                  @elseif ($projet->etat=='reçu')
                    <span class="badge badge-warning">Reçu</span>
                  @elseif ($projet->etat=='annulé')
                    <span class="badge badge-danger">Annulé</span>
                  @else
                    <span class="badge badge-info">{{$projet->etat}}</span>
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

              @if (!empty($non_reçu))
                @foreach ($non_reçu as $projet)
                <tr> 	
                  <td class="text-center"> <a href="/previsions/{{$projet->id}}">{{$projet->nom}}</a> </td>
                  <td ><span class="badge badge-danger">Non reçu</span></td>
                  <td class="text-center"> </td>
                  <td class="text-center"> {{$projet->date_reception}}</td>
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
              @endif
            </tbody>
          </table> 
        </div>
      </div>
    </div>
  </div>     
</div>                
@endsection