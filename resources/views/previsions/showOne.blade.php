@extends ('layouts.master')
@section('content')
<div class="row">                                        
  <div class="col-lg-10 offset-lg-1 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h2 >Application : {{$application->nom}}</h2>
        <div class="line"></div>
        <div class="">
          <table class="table table-bordered">
            <tr>  
              <th class="text-center font-weight-bold"> Nature client</th>
              <td class="text-center">{{ $application->nature_client}}</td> 
            </tr>
            <tr>
             <th class="text-center font-weight-bold"> Client</th>
              <td class="text-center">{{ $application->client}}</td>
            </tr>
            <tr>
              <th class="text-center font-weight-bold"> Date de récpetion</th>
              <td class="text-center">{{ $application->created_at}}</td>
            </tr>
            <tr>
              <th class="text-center font-weight-bold"> Date Prévu de passage en production</th>
              <td class="text-center">{{ $application->date_prevu_prod}}</td>
            </tr>
            <tr>
               <th class="text-center font-weight-bold"> Technologies utilisées</th>
               <td class="text-center"> 
                  @foreach ($application->technologies as $tech)
                   <span class="badge badge-info">{{$tech->designation}}</span>
                  @endforeach
                   @if ($application->autre_tech)
                    <span class="badge badge-info">{{$application->autre_tech}}</span>
                  @endif
              </td>
            </tr>
          <tr>
           <th class="text-center font-weight-bold"> Etat</th>
            <td class="text-center"> 
              @if ($application->isValid)     {{'Valide'}}
              @else                           {{'Invalide'}}
              @endif
            </td>
          </tr>                  
        </table> <br>
        <div class="row"> 
         @if (!$application->isValid)
          <div class="col-md-1 offset-md-1 ">
            <a class="btn btn-success  btn-sm" href="/previsions/valider/{{$application->id}}"><i class="mdi mdi-check"></i> Valider</a>
          </div>
          @endif
          <div class="col-md-1 offset-md-1">
            <a class="btn btn-dark btn-sm " href="/previsions/modifier/{{$application->id}}"><i class="mdi mdi-cloud-download"></i> Modifier</a>
          </div> 
          <div class="col-md-3 offset-md-1">
            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePrevision" data-id="{{$application->id}}" href=""><i class="mdi mdi-delete"></i> Supprimer</a>    
          </div>
          </div>
		  @include ('popups.previsions.deletePrevision')
        </div>
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
