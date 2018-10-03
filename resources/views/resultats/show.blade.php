@extends('layouts.master')
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
	                <table class="table table-bordered  table-reponsive">
						<thead>
							<th class="text-center font-weight-bold"> Nom de l'application</th>
							<th  class="text-center font-weight-bold"> Procédure</th>
							<th  class="text-center font-weight-bold"> Etat</th>							
							<th  class="text-center font-weight-bold"> Elevées</th>
							<th  class="text-center font-weight-bold"> Moyennes</th>
							<th  class="text-center font-weight-bold"> Faibles</th>
							<th  class="text-center font-weight-bold"> Total</th>
						</thead>
						<tbody>
							@foreach ($projets as $projet)
							<tr >
								<td class="text-center">
									<a href="/projets/{{$projet->id}}">{{$projet->application->nom }}</a>
								</td>
								@if ($projet->procedure)
									<td class="text-center">{{$projet->procedure->designation}}</td>
								@else
								<td class="text-center"></td>
								@endif
								<td class="text-center">{{$projet->etat}}</td>
								@if ($projet->etat=="cloturé")
									<td class="text-center">{{$projet->vuln_eleves }}</td>
									<td class="text-center">{{ $projet->vuln_moyennes}}</td>
									<td class="text-center">{{ $projet->vuln_moyennes}}</td>
									<td class="text-center">{{$projet->vuln_eleves + $projet->vuln_moyennes+$projet->vuln_faibles}}</td>
								@else
									<td class="text-center vuln_eleves" id="vuln_eleves"  data-id2="{{$projet->id}}" contenteditable="">{{$projet->vuln_eleves }}</td>
									<td class="text-center vuln_moyennes" id="vuln_moyennes"  data-id3="{{$projet->id}}" contenteditable="">{{ $projet->vuln_moyennes}}</td>
									<td class="text-center vuln_faibles" id="vuln_faibles" data-id4="{{$projet->id}}" contenteditable="">{{$projet->vuln_faibles}}</td>
									<td class="text-center vuln" id="total{{$projet->id}}"  data-id1="{{$projet->id}}">{{$projet->vuln_eleves + $projet->vuln_moyennes+$projet->vuln_faibles}}</td>
								@endif
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