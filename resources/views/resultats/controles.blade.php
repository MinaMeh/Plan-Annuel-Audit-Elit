@extends ('layouts.master')
@section('content')
<div class="row">                                        
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="line"></div>
        <div class="btn-group" role="group">
        
         <a  class="btn btn-secondary" href="/vulnerabilitesTypes"> Types de vulnérabilités</a>  
          <a  class="btn btn-secondary" href="/vulnerabilites"> Vulnérabilités</a>
          <a  class="btn btn-secondary" href="/controles"> Controles</a>
        </div>
        <div class="line"></div>
        <div class="table-responsive">
          <table class="table table-reponsive table-bordered">
            <thead>
      				<th class="text-center"> Application</th>
      				@foreach ($controles as $controle)
      				   <th class="text-center" id="{{$controle->id}}"> {{$controle->designation}}</th>
      				@endforeach
      		  </thead>
			      <tbody>
				      @foreach ($projets as $projet)
        				<tr>
        					<td class="text-center" ><a href="/projets/{{$projet->id}}">{{$projet->application->nom}}</a></td>
        					@foreach ($projet->controles as $controle)
                    @if($projet->etat=="cloturé")
                     <td class="controle text-center"  data-controle="{{$controle->id}}" data-projet="{{$projet->id}}"> {{$controle->pivot->nbr}}</td> 
                    @else
          					 <td class="controle text-center"  contenteditable data-controle="{{$controle->id}}" data-projet="{{$projet->id}}"> {{$controle->pivot->nbr}}</td> 
                     @endif
                  @endforeach      				
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