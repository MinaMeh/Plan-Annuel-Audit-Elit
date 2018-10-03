@extends ('layouts.master')
@section('content')
<div class="row">                                        
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">        
            <h4 class="font-weight-bold">Liste des réponses reçues </h4>         
          <div class="row purchace-popup">
          <div class="col-12">

            <span class="d-block d-md-flex align-items-center">
              <a class="btn ml-auto download-button d-none d-md-block" href="/previsions/create"><i class="mdi mdi-message-plus"></i> Ajouter une réponse </a>
            </span>
          </div>
        </div>
     
        <div class="line"></div>
        <div class="btn-group" role="group">
          @if (request('plan'))
              <a  class="btn btn-secondary" href="/previsions?plan={{request('plan')}}"> Toutes</a>
          @else
              <a  class="btn btn-secondary" href="/previsions"> Toutes</a>
          @endif
          @if (request('plan'))
              <a  class="btn btn-secondary" href="/previsions/valide?plan={{request('plan')}}"> Validées</a>
          @else
              <a  class="btn btn-secondary" href="/previsions/valide"> Validées</a>
          @endif
          @if (request('plan'))
            <a  class="btn btn-secondary" href="/previsions/invalide?plan={{request('plan')}}"> Non Validées</a>
          @else
          <a  class="btn btn-secondary" href="/previsions/invalide"> Non Validées</a>
          @endif
        </div>
                <div class="line"></div>

        <div class="table-responsive">
          <table class="table table-bordered">
            <thead >
              <tr>  
                <th class="text-center font-weight-bold" colspan="2"> Nom de l'application</th>
                <th class="text-center font-weight-bold"> Nature du client</th>
                <th class="text-center font-weight-bold"> Client</th>
                <th class="text-center font-weight-bold"> Date Prévu pour passage <br> en production</th>
                <th class="text-center font-weight-bold"> Technologies </th>
                <th class="text-center font-weight-bold"> Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($previsions as $prevision)
              <tr>
                <td class="text-center">
                  <a href="/previsions/{{$prevision->id}}"> {{$prevision->nom}}</a>
                </td>
                <td>
                  @if ($prevision->isValid)
                  <span class="badge badge-success"><i class="mdi mdi-check"></i> Validée</span>
                  @else
                  <span class="badge badge-danger"><i class="mdi mdi-close"></i> Non validée</span>
                  @endif 
                </td>
                <td class="text-center">{{$prevision->nature_client}}</td>
                <td class="text-center">{{$prevision->client}}</td>
                <td class="text-center">{{$prevision->date_prevu_prod}}</td>
                <td class="text-center"> 
                  @foreach ($prevision->technologies as $tech) 
                    <span class="badge badge-info">{{$tech->designation}}</span>
                  @endforeach
                  @if ($prevision->autre_tech)
                    <span class="badge badge-info">{{$prevision->autre_tech}}</span>
                  @endif
                </td>
                <td class="text-center"> 
                  @if (!$prevision->isValid)
                    <a class="btn btn-inverse-success btn-sm" href="/previsions/valider/{{$prevision->id}}"><span class="mdi mdi-check" aria-hidden='true'></span></a>
                  @else
                    <a disabled class="disabled btn btn-inverse-success btn-sm" href="/previsions/valider/{{$prevision->id}}"><span class="mdi mdi-check" aria-hidden='true'></span></a>
                  @endif
                   <a class="btn btn-inverse-danger btn-sm"  data-toggle="modal" data-target='#deletePrevision' data-id="{{$prevision->id}}" href="#"><span class="mdi mdi-delete"></span></a>      
                    <a class="btn btn-inverse-primary btn-sm " href="/previsions/modifier/{{$prevision->id}}"><span class="mdi mdi-pencil"></span></a>
                </td>
              </tr>
              @endforeach
              @include('popups.previsions.deletePrevision')
            </tbody>
          </table> 
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

