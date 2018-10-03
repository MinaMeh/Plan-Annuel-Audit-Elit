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
      				@foreach ($vulnerabilites as $vulnerabilite)
      				   <th class="text-center" id="{{$vulnerabilite->id}}"> {{$vulnerabilite->designation}}</th>
      				@endforeach
      		  </thead>
			      <tbody>
				      @foreach ($projets as $projet)
                @if ($projet->etat=="cloturé")
                  <tr>
                      <td ><a href="/projets/{{$projet->id}}">{{$projet->application->nom}}</a></td>
                      @foreach ($projet->vulnerabilites as $vulnerabilite)
                      <td class="vulnerabilite text-center"  data-vulnerabilite="{{$vulnerabilite->id}}" data-projet="{{$projet->id}}"> {{$vulnerabilite->pivot->nbr}}</td> 
                      @endforeach             
                    </tr>
                @else
            				<tr>
            					<td ><a href="/projets/{{$projet->id}}">{{$projet->application->nom}}</a></td>
            					@foreach ($projet->vulnerabilites as $vulnerabilite)
            					<td class="vulnerabilite text-center" contenteditable data-vulnerabilite="{{$vulnerabilite->id}}" data-projet="{{$projet->id}}"> {{$vulnerabilite->pivot->nbr}}</td> 
                      @endforeach      				
            				</tr>
                  @endif
				      @endforeach
			      </tbody>
          </table>        
        </div>
      </div>
    </div>
  </div>     
</div>       

@endsection