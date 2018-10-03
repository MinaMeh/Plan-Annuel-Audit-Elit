@extends('layouts.master')
@section('content')
{!! Charts::assets() !!}
<div class="row">
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
	        <div class="card-body">
	            <div class="clearfix">
		            <div class="float-left">
		                <i class="mdi mdi-calendar-clock mdi-48px text-primary icon-lg"></i>
		            </div>
		            <div class="float-right">
		                <p class="mb-0 text-right">Projets <br> prévus</p>
		                <div class="fluid-container">
		               		 <h3 class="font-weight-medium text-right mb-0">{{$nbr_projets_prev}}</h3>
		                </div>
		            </div>
	            </div>        
	        </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
	        <div class="card-body">
	            <div class="clearfix">
		            <div class="float-left">
		                <i class=" mdi mdi-check-circle mdi-48px text-success icon-lg"></i>
		            </div>
		            <div class="float-right">
		                <p class="mb-0 text-right">Demandes <br> reçues</p>
		                <div class="fluid-container">
		              	  <h3 class="font-weight-medium text-right mb-0">{{$nbr_demandes}}</h3>
		                </div>
		            </div>
	            </div>       
	        </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card card-statistics">
	        <div class="card-body">
	            <div class="clearfix">
		            <div class="float-left">
		                <i class=" mdi mdi-minus-circle text-danger icon-lg"></i>
		            </div>
			            <div class="float-right">
			              <p class="mb-0 text-right"> Vulnérabilitées <br>détectées</p>
			              <div class="fluid-container">
			                 <h3 class="font-weight-medium text-right mb-0">{{$vuln[0]+$vuln[1]+$vuln[2]}}</h3>
			              </div>
			            </div>
	            </div>
	        </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
      <div class="card card-statistics">
	        <div class="card-body">
	            <div class="clearfix">
		            <div class="float-left">
		                <i class="mdi mdi-playlist-play text-primary icon-lg"></i>
		            </div>
		            <div class="float-right">
		                <p class="mb-0 text-right"> Projets <br> en cours</p>
		                <div class="fluid-container">
		               		<h3 class="font-weight-medium text-right mb-0">{{$nbr_projets_encours}}</h3>
		                </div>
		            </div>
	            </div>	          
	        </div>
        </div>
    </div>
</div>
<div class="bloc mg-bottom">
	<div class="row">
		<div class="col-md-6">
			{!! $planChart->render() !!}
		</div>
		<div class="col-md-4  offset-md-1">
			<div class="card-title">
				Répartition des projets par plans
			</div>
			<div class="card-body" >
				<table class="table table-reponsive table-bordered">
					<thead>
						<th class="text-center"> Plan</th>
						<th class="text-center"> Nombre de projets</th>
					</thead>
					<tbody>
						<?php $total=0; ?>
						@foreach ($planStat as $item)
						<tr>
							<td class="text-center">{{ $item->nom}}</td>
							<td class="text-center"> {{$item->nbr_prj}}</td>
							<?php $total+=$item->nbr_prj; ?>
						</tr>
						@endforeach
					</tbody>
					<tr>	
						<th class="text-center">Total	</th>
						<td class="text-center">	{{$total}}</td>
					</tr>
				</table>
			</div>
		</div>		
	</div>
</div>
<div class="bloc">
	<div class="row ">
		<div class="col-md-5 ">
			<div class="card-title">
				Répartition des applications selon les technologies
			</div>
			<div class="card-body">
				<table class="table table-reponsive table-bordered">
					<thead>
						<th class="text-center"> Technologie</th>
						<th class="text-center"> Nombre d'application</th>
					</thead>
					<body>
						<?php $total=0; ?>

						@foreach($technologies as $tech)
						<tr>
							<td class="text-center">{{$tech->designation}}</td>
							<td style="text-align: center;">{{$tech->nbr_apps}}</td>
							<?php $total+=$tech->nbr_apps; ?>

						</tr>
						@endforeach
						<tr>
							<td class="text-center">Autre</td>
							<td style="text-align: center">{{$autre}}</td>
							<?php $total+=$autre; ?>

						</tr>
						<tr>	
							<th class="text-center">Total</th>
							<td  style="text-align: center">{{$total}}</td>
						</tr>
					</body>
				</table>
			</div>
		</div>
		<div class="col-md-6 offset-md1">
			{!! $technologiesChart->render() !!}		
		</div>
	</div>
</div>
<div class="bloc mg-bottom">
	<div class="row">
		<div class="col-md-6">
			{!! $etatChart->render() !!}
		</div>
		<div class="col-md-4  offset-md-1">
			<div class="card-title">
				Répartition des projets par état
			</div>
			<div class="card-body" >
				<table class="table table-reponsive table-bordered">
					<thead>
						<th class="text-center"> Etat</th>
						<th class="text-center"> Nombre de projets</th>
					</thead>
					<tbody>
						<?php $total=0; ?>
						@foreach ($etat as $ligne)
						<tr>
							<td class="text-center">{{ $ligne->etat}}</td>
							<td class="text-center"> {{$ligne->nbr_apps}}</td>
							<?php $total+=$ligne->nbr_apps; ?>
						</tr>
						@endforeach
						<th class="text-center">Total</th>
						<td class="text-center">{{$total}}</td>
					</tbody>
				</table>
			</div>
		</div>		
	</div>
</div>
<div class="bloc">
	<div class="row ">
		<div class="col-md-12 ">
			<div class="card-title">
				Répartition des applications selon les procédures
			</div>
			<div class="card-body">
				<div class="table-reponsive">	
							<table class="table  table-bordered">
								<thead>
									<th class="text-center"> Code </th>
									<th class="text-center"> Procédure</th>
									<th class="text-center"> Nombre d'application</th>
								</thead>
								<body>
									<?php $total=0; ?>
									@foreach($procedure as $pro)
									<tr>
										<td class="text-center">{{$pro->code}}</td>
										<td class="text-center">{{$pro->designation}}</td>
										<td style="text-align: center;">{{$pro->nbr_apps}}</td>
										<?php $total+=$pro->nbr_apps; ?>
									</tr>
									@endforeach
									<tr>	
											<th colspan="2"  class="text-center">Total</td>
											<td style="text-align: center;">{{$total}}</td>
									</tr>
								</body>
							</table>
				</div>
			</div>
		</div>
		<div class="col-md-12 ">
			{!! $procedureChart->render() !!}
		</div>
	</div>
</div>
<div class="bloc mg-bottom">
	<div class="row">

		<div class="col-md-7">
			{!! $previsionChart->render() !!}
		</div>
		<div class="col-md-4  offset-md-1">
			<div class="card-title">
				Répartition des projets par prévision
			</div>
			<div class="card-body" >
				<table class="table table-reponsive table-bordered">
					<thead>
						<th class="text-center"> Prevision</th>
						<th class="text-center"> Nombre de projets</th>
					</thead>
					<tbody>
						<?php $total=0; ?>
						@foreach ($prevision as $ligne)
						<tr>
							<td class="text-center">{{ $ligne->prevision}}</td>
							<td class="text-center"> {{$ligne->nbr_apps}}</td>
							<?php $total+=$ligne->nbr_apps; ?>
						</tr>
						<tr>	
							<th class="text-center">Total</th>
							<td class="text-center">{{$total}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>		
	</div>
</div>
<div class="bloc">
	<div class="row ">
		<div class="col-md-6 ">
			<div class="card-title">
				Répartition des projets par prévision/état
			</div>
			<div class="card-body">
				<table class="table table-reponsive table-bordered">
					<thead>
						<th> Prévision </th>
						<th> Etat</th>
						<th> Nombre d'application</th>
					</thead>
					<body>
						
						<tr>
							<td rowspan="3" class="text-center">PA</td>
							<td class="text-center"> Fait</td>
							<td class="text-center"> {{$prevision_etat['PA_fait']}}</td>
						</tr>
						<tr>						
							<td class="text-center"> En cours</td>
							<td class="text-center"> {{$prevision_etat['PA_encours']}}</td>
						</tr>
						<tr>						
							<td class="text-center"> Non fait</td>
							<td class="text-center"> {{$prevision_etat['PA_nonFait']}}</td>
						</tr>
						<tr>
							<td rowspan="3" class="text-center">NP</td>
							<td class="text-center"> fait</td>
							<td class="text-center"> {{$prevision_etat['NP_fait']}}</td>
						</tr>
						<tr>						
							<td class="text-center"> En cours</td>
							<td class="text-center"> {{$prevision_etat['NP_encours']}}</td>
						</tr>
						<tr>						
							<td class="text-center"> Non fait</td>
							<td class="text-center"> {{$prevision_etat['NP_nonFait']}}</td>
						</tr>
						<tr>
							<th colspan="2" class="text-center">Total</th>
							<td class="text-center"> <?php  echo collect($prevision_etat)->sum()?></td>
						</tr>
					</body>
				</table>
			</div>
		</div>
		<div class="col-md-6 ">
			{!! $prevision_etatChart->render() !!}		
		</div>
	</div>
</div>

<div class="bloc mg-bottom">
	<div class="row">
		<div class="col-md-7">
			{!! $typeChart->render() !!}
		</div>
		<div class="col-md-3  offset-md-1">
			<div class="card-title">
				Répartition des projets par types d'application
			</div>
			<div class="card-body" >
				<table class="table table-reponsive table-bordered">
					<thead>
						<th  class="text-center"> Type</th>
						<th class="text-center"> Nombre de projets</th>
					</thead>
					<tbody>
						<?php $total=0 ; ?>
						@foreach ($type as $ligne)
						<tr>
							<td class="text-center">{{ $ligne->designation}}</td>
							<td class="text-center"> {{$ligne->nbr_apps}}</td>
							<?php $total+=$ligne->nbr_apps ; ?>
						</tr>
						@endforeach
						<tr>	
							<th class="text-center">Total</th>
							<td class="text-center">{{$total}}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>		
	</div>
</div>
<div class="bloc">
	<div class="row ">
		<div class="col-md-6 ">
			<div class="card-title">
				Répartition des projets par prévision/état
			</div>
			<div class="card-body">
				<table class="table table-reponsive table-bordered">
					<thead>
						<th class="text-center"> Trimestre </th>
						<th class="text-center"> Nombre de projets</th>
					</thead>
					<body>
						<?php  $total=0 ?>
						@foreach($trimestre as $item)
						<tr>
							<td class="text-center"><a href="/projets/?trimestre={{$item->trimestre}}">Trimestre {{$item->trimestre}}</a></td>
							<td class="text-center">{{$item->nbr_prj}}</td>
							<?php  $total+=$item->nbr_prj?>

						</tr>
						@endforeach
						<tr>
							<th class="text-center">Total</th>
							<td class="text-center"> {{$total}}</td>
						</tr>
					</body>
				</table>
			</div>
		</div>
		<div class="col-md-6 ">
			{!! $trimestreChart->render() !!}			
		</div>
	</div>
</div>
<div class="bloc">
	<div class="row ">
		<div class="col-md-4 ">
			<div class="card-title">
				Nombre de vulnérabilités
			</div>
			<div class="card-body">
				<table class="table table-reponsive table-bordered">				
					<body>
						<?php  $total_vuln=0 ?>					
						<tr>
							<th  class="text-center">Faibles</th>
							<td  class="text-center">{{$vuln[0]}}</td>					
							<?php  $total_vuln+=$vuln[0]?>
						</tr>
						<tr>
							<th  class="text-center">Moyennes</th>
							<td  class="text-center">{{$vuln[1]}}</td>					
							<?php  $total_vuln+=$vuln[1]?>
						</tr>
						<tr>
							<th  class="text-center">Elevés</th>
							<td  class="text-center">{{$vuln[2]}}</td>					
							<?php  $total_vuln+=$vuln[2]?>
						</tr>
						<tr>
							<th  class="text-center">Total</th>
							<td class="text-center"> {{$total_vuln}}</td>
						</tr>
					</body>
				</table>
			</div>	
		</div>
			<div class="col-md-6 offset-md-2 ">
				{!! $vulnChart->render() !!}				
			</div>
		</div>
	</div>
<div class="bloc">
	<div class="row ">
		<div class="col-md-12 ">
			{!! $controleChart->render() !!}
		</div>
		<div class="col-md-6 offset-md-3">		
			<div class="card-title">
				Nombre de vulnérabilités par controle
			</div>
			<div class="card-body">
				<table class="table table-reponsive table-bordered">	
					<thead>	
						<th class="text-center">Controles</th>
						<th class="text-center">Nombre de vulnérabilités</th>
					</thead>
					<body>
						<?php $total=0 ; ?>
						@foreach ($controle as $item)
						<tr>
							<th  class="text-center"> {{$item->designation}}</th>
							<td  class="text-center">{{$item->nbr_vul}}</td>	
							<?php $total+= $item->nbr_vul; ?>				
						</tr>	
						@endforeach
					</body>
					<tr>	
						<th  class="text-center">Total</th>
						<td class="text-center">{{$total}}</td>
					</tr>
				</table>
			</div>
		</div>
		</div>
</div>
@endsection