@extends('layouts.master')
@section ('content')
@include('errors.bddErrors')
<div class="row">
	<div class="col-lg-12">
	@include ('errors.errors')
	</div>
	<div class="col-lg-12 grid-margin stretch-card">
	    <div class="card">
		    <div class="card-body">			   
               <h4 class="font-weight-bold">Utilisateurs :</h4> 
               <div class="row purchace-popup">
		          <div class="col-12">
		            <span class="d-block d-md-flex align-items-center">
		              <a class="btn ml-auto download-button d-none d-md-block" data-toggle="modal" data-target="#addUser"  name=""><i class="mdi mdi-account-plus"></i> Ajouter un utilisateur</a>
		              @include ('popups.users.addUser')
		              <a class="btn download-button mt-4 mt-md-0" data-toggle="modal" data-target="#addRole"  name=""><span class="mdi mdi-plus-circle-outline"></span> Ajouter un rôle</a>
		             @include ('popups.users.addRole') 
		            </span>
		          </div>
		        </div>
		        <div class="line"></div>
		        <div class="table-responsive">
			        <table class="table table-bordered">
			          <thead >
			            <tr>  
			              <th class="text-center font-weight-bold"> Nom</th>
			              <th class="text-center font-weight-bold"> Email</th>
			              <th class="text-center font-weight-bold"> Rôle</th>
			              <th class="text-center font-weight-bold"> Action</th>
			            </tr>
			          </thead>
			          <tbody>
			            @foreach ($users as $user)
			            <tr>
			              <td class="text-center">{{$user->name}}</td>
			              <td class="text-center">{{$user->email}}</td>
			              <td class="text-center">{{$user->role->designation}}</td>
			              <td class="text-center">
			                <a class="btn btn-inverse-danger" data-toggle="modal" data-target="#deleteUser" data-id="{{$user->id}}" href="#"><span class="mdi mdi-delete"></span></a>
			                <a class="btn btn-inverse-primary "data-toggle="modal" data-target="#editUser" data-id="{{$user->id}}" data-name="{{$user->name}}" data-email="{{$user->email}}" data-password="{{$user->password}}" data-role="{{$user->role}}" href=""><span class="mdi mdi-pencil"></span></a>
			              </td>
			            </tr>
			            @endforeach
			            @include ('popups.users.editUser')
			            @include ('popups.users.deleteUser')
			          </tbody>
			        </table>
	        	</div>
		    </div>
		</div>
	</div>
	<div class="col-lg-12 grid-margin stretch-card">
	    <div class="card">
	        <div class="card-body">
		        <h4 class="font-weight-bold">Procédures :</h4> 
			    <div class="row purchace-popup">
		          <div class="col-12">
		            <span class="d-block d-md-flex align-items-center">
		              <a class="btn ml-auto download-button d-none d-md-block" data-toggle="modal" data-target="#addProcedure"  name=""><i class="mdi mdi-plus-circle-outline"></i> Ajouter</a>
		            </span>
		            @include ('popups.procedures.addProcedure')
		          </div>
		        </div>		        
	        	<div class="line"></div>
		        <div class="table-responsive">
			        <table class="table table-bordered">
			            <thead >
			              <tr>  
			                <th class="text-center font-weight-bold"> Code</th>
			                <th class="text-center font-weight-bold"> Designation</th>
			                <th class="text-center font-weight-bold"> Fiche <br>technique</th>
			                <th class="text-center font-weight-bold"> Action</th>
			              </tr>
			            </thead>
			            <tbody>
			              @foreach ($procedures as $procedure)
			              <tr>
			                <td class="text-center">{{$procedure->code}}</td>
			                <td class="text-center">{{$procedure->designation}}</td>
			   				 <td class="text-center"><a href="/procedures/fiches/{{$procedure->id}}">Fiche technique</a></td>

			                <td class="text-center">
			                  <a class="btn btn-inverse-danger" data-toggle="modal" data-target="#deleteProcedure" data-id="{{$procedure->id}}" href="#"><span class="mdi mdi-delete"></span></a>
			                  <a class="btn btn-inverse-primary "data-toggle="modal" data-target="#editProcedure" data-id="{{$procedure->id}}" data-designation="{{$procedure->designation}}" data-code="{{$procedure->code}}" href=""><span class="mdi mdi-pencil"></span></a>
			                </td>
			              </tr>
			              @endforeach
			              @include ("popups.procedures.editProcedure")
			              @include ("popups.procedures.deleteProcedure")
			            </tbody>
	          		</table>
		        </div>
	        </div>
	    </div>
	</div>
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="font-weight-bold">Controles :</h4>
                 <div class="row purchace-popup">
		          <div class="col-12">
		            <span class="d-block d-md-flex align-items-center">
		              <a class="btn ml-auto download-button d-none d-md-block" data-toggle="modal" data-target="#addControle" name=""><i class="mdi mdi-plus-circle-outline"></i> Ajouter</a>
		            </span>
		             @include ('popups.controles.addControle')
		         </div>
		        </div> 
	              
            	<div class="line"></div>
	            <div class="table-responsive">
	                <table class="table table-bordered">
		                <thead >
		                  <tr>  
		                    <th class="text-center font-weight-bold"> Designation</th>
		                    <th class="text-center font-weight-bold"> Description</th>
		                    <th class="text-center font-weight-bold"> Action</th>
		                  </tr>
		                </thead>
		                <tbody>
		                  @foreach ($controles as $controle)
		                  <tr>
		                    <td class="text-center">{{$controle->designation}}</td>
		                	<td class="text-center">{{$controle->description}}</td>

		                    <td class="text-center">
		                      <a class="btn btn-inverse-danger" data-toggle="modal" data-target="#deleteControle"  data-id="{{$controle->id}}" href="#"><span class="mdi mdi-delete"></span></a>
		                      <a class="btn btn-inverse-primary "data-toggle="modal" data-target="#editControle" data-id="{{$controle->id}}" data-description="{{$controle->description}}" data-designation="{{$controle->designation}}" href=""><span class="mdi mdi-pencil"></span></a>
		                    </td>
		                  </tr>
		                  @endforeach
		                  @include ('popups.controles.editControle')
	                  	  @include ('popups.controles.deleteControle')
		                </tbody>
	                </table>
	            </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
       		<div class="card-body">
          	 	 <h4 class="font-weight-bold">Types :</h4> 		            
          		 <div class="row purchace-popup">
		          <div class="col-12">
		            <span class="d-block d-md-flex align-items-center">
		              <a class="btn ml-auto download-button d-none d-md-block" data-toggle="modal" data-target="#addType" name=""><i class="mdi mdi-plus-circle-outline"></i> Ajouter</a>
		            </span>
		             @include ('popups.types.addType')
		          </div>
		        </div>	
            	<div class="line"></div>
	            <div class="table-responsive">
		            <table class="table table-bordered">
		              <thead >
		                <tr>  
		                  <th class="text-center font-weight-bold"> Designation</th>
		                  <th class="text-center font-weight-bold"> Description</th>

		                  <th class="text-center font-weight-bold"> Action</th>
		                </tr>
		              </thead>
		              <tbody>
		                @foreach ($types as $type)
		                <tr>
		                  <td class="text-center">{{$type->designation}}</td>
		                	 <td class="text-center">{{$type->description}}</td>

		                  <td class="text-center">
		                    <a class="btn btn-inverse-danger" data-toggle="modal" data-target="#deleteType"  data-id="{{$type->id}}" href="#"><span class="mdi mdi-delete"></span></a>
		                    <a class="btn btn-inverse-primary "data-toggle="modal" data-target="#editType" data-id="{{$type->id}}" data-description="{{$type->description}} "data-designation="{{$type->designation}}" href=""><span class="mdi mdi-pencil"></span></a>
		                  </td>
		                </tr>
		                @endforeach
		                @include ('popups.types.editType')
		                @include ('popups.types.deleteType')
		              </tbody>
		            </table>
	            </div>
        	</div>
      	</div>
    </div>
        <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
	            <h4 class="font-weight-bold">Vulnérabilités :</h4>
	            <div class="row purchace-popup">
		          <div class="col-12">
		            <span class="d-block d-md-flex align-items-center">
		              <a class="btn ml-auto download-button d-none d-md-block" data-toggle="modal" data-target="#addVuln" name=""><i class="mdi mdi-plus-circle-outline"></i> Ajouter</a>
		            </span>
		             @include ('popups.vulnerabilites.addVuln')
		          </div>
		        </div>
            	<div class="line"></div>
	            <div class="table-responsive">
	              <table class="table table-bordered">
	                <thead >
	                  <tr>  
	                    <th class="text-center font-weight-bold"> Designation</th>
	                    <th class="text-center font-weight-bold"> Description</th>
	                    <th class="text-center font-weight-bold"> Action</th>
	                  </tr>
	                </thead>
	                <tbody>
	                  @foreach ($vulnerabilites as $vuln)
	                  <tr>
	                    <td class="text-center">{{$vuln->designation}}</td>
	                    <td class="text-center">{{$vuln->description}}</td>
	                    <td class="text-center">
	                      <a class="btn btn-inverse-danger" data-toggle="modal" data-target="#deleteVuln" data-id="{{$vuln->id}}" href="#"><span class="mdi mdi-delete"></span></a>
	                      <a class="btn btn-inverse-primary "data-toggle="modal" data-target="#editVuln" data-id="{{$vuln->id}}" data-description="{{$vuln->description}}"data-designation="{{$vuln->designation}}" href=""><span class="mdi mdi-pencil"></span></a>
	                    </td>
	                  </tr>
	                  @endforeach
			          @include ('popups.vulnerabilites.editVuln')
	                  @include ('popups.vulnerabilites.deleteVuln')
	                </tbody>
	              </table>
	            </div>
            </div>
        </div>
    </div>
    
        <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
	            <h4 class="font-weight-bold">Technologies :</h4>
	            <div class="row purchace-popup">
		          <div class="col-12">
		            <span class="d-block d-md-flex align-items-center">
		              <a class="btn ml-auto download-button d-none d-md-block" data-toggle="modal" data-target="#addTech" name=""><i class="mdi mdi-plus-circle-outline"></i> Ajouter</a>
		            </span>
		             @include ('popups.technologies.addTechnologie')
		          </div>
		        </div>
            	<div class="line"></div>
	            <div class="table-responsive">
	              <table class="table table-bordered">
	                <thead >
	                  <tr>  
	                    <th class="text-center font-weight-bold"> Designation</th>
	                    <th class="text-center font-weight-bold"> Description</th>
	                    <th class="text-center font-weight-bold"> Action</th>
	                  </tr>
	                </thead>
	                <tbody>
	                  @foreach ($technologies as $tech)
	                  <tr>
	                    <td class="text-center">{{$tech->designation}}</td>
	                    <td class="text-center">{{$tech->description}}</td>
	                    <td class="text-center">
	                      <a class="btn btn-inverse-danger" data-toggle="modal" data-target="#deleteTech" data-id="{{$tech->id}}" href="#"><span class="mdi mdi-delete"></span></a>
	                      <a class="btn btn-inverse-primary "data-toggle="modal" data-target="#editTech" data-id="{{$tech->id}}" data-description="{{$tech->description}}"data-designation="{{$tech->designation}}" href=""><span class="mdi mdi-pencil"></span></a>
	                    </td>
	                  </tr>
	                  @endforeach
			          @include ('popups.technologies.editTechnolgie')
	                  @include ('popups.technologies.deleteTechnolgie')
	                </tbody>
	              </table>
	            </div>
            </div>
        </div>
    </div>
    

    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="font-weight-bold">Départements :</h4> 
	            <div class="row purchace-popup">
		          <div class="col-12">
		            <span class="d-block d-md-flex align-items-center">
		              <a class="btn ml-auto download-button d-none d-md-block" data-toggle="modal" data-target="#addDepartement" name=""><i class="mdi mdi-plus-circle-outline"></i> Ajouter</a>
		            </span>
		             @include('popups.departements.addDepartement')
		         </div>
		        </div>
                <div class="line"></div>
                <div class="table-responsive">
	                <table class="table table-bordered">
	                  <thead >
	                    <tr>  
	                      <th class="text-center font-weight-bold"> Département</th>
	                      <th class="text-center font-weight-bold"> Nature</th>
	                      <th class="text-center font-weight-bold"> Action</th>
	                    </tr>
	                  </thead>
	                  <tbody>
	                    @foreach ($departements as $departement)
	                    <tr>
	                      <td class="text-center">{{$departement->designation}}</td>
	                      <td class="text-center"> {{$departement->nature}}</td>
	                      <td class="text-center">
	                        <a class="btn btn-inverse-danger" data-toggle="modal" data-target="#deleteDepartement" data-id="{{$departement->id}}" href="#"><span class="mdi mdi-delete"></span></a>
	                        <a class="btn btn-inverse-primary "data-toggle="modal" data-target="#editDepart" data-id="{{$departement->id}}" data-designation="{{$departement->designation}}" href=""><span class="mdi mdi-pencil"></span></a>
	                      </td>
	                    </tr>
	                    @endforeach
	                    @include ('popups.departements.editDepartement')
	                    @include('popups.departements.deleteDepartement')
	                  </tbody>
	                </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection