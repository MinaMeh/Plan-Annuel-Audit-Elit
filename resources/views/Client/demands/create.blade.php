@extends('layouts.client')
@section('client')
<div class="row ">
	<div class="col-md-8 grid-margin stretch-card">
	    <div class="card card1 ">
		    <div class="card-body">
		        <h3 class="card-title">Veuillez saisir les informations suivantes :</h3>
		        @include('errors.errors')
		        <form method="post" action="/demands/step1" id="demande" enctype="multipart/form-data">
		            {{csrf_field()}}
			        <div class="form-group">
			            <label for="nature_client" class="font-weight-bold"> Nature du client</label>
		                <select id="nature_client_demande" class="form-control" name="nature_client" required>
			                <option value="-1" selected></option>
			                <option value="Interne"> Interne</option>
			                <option value="Externe"> Externe</option>
		                </select>                              
			        </div>
		            <div class="form-group">
		            	<label for="client" class="font-weight-bold"> Client</label>
			            <select id="client_demande" class="form-control" name="client" required>
			                <option value="-1" selected></option>
			            </select>
		            </div>
		            <div class="form-group">
		            <label for="nom" class="font-weight-bold"> Nom de l'application</label>
		            	<select id="apps_list" class="form-control" name="nom" required>
		                	<option selected value="-1"></option>
		                </select>          
		            </div>
		            <div class="form-group">
		            	<label class="font-weight-bold">Changer le nom de la'application</label>
			            <div class="form-check form-check-flat">
			              <div class="form-check">
			                  <label class="form-check-label">
			                    <input type="checkbox" class="form-check-input" name="tech" id="change">
			                  </label>
			              </div>
			            </div>

		            </div> <br>
		            <div class="form-group">
		    			<input class="form-control collapse" type="text" name="new_name" id="change_nom">

		            </div>
		            <div class="form-group">
		                <label for="chef_projet" class="font-weight-bold"> Chef du projet</label>
		                <input type="text" class="form-control" name="chef_projet" required id="chef_projet">                            
		            </div>
		            <div class="form-group">
		            	<label for="chef_projet" class="font-weight-bold"> Chef du projet -Email-</label>
		            	<input type="email" class="form-control" required name="email_chef_projet" id="email_chef_projet">                            
		            </div>
		            <div class="form-group">
		           	 	<label for="type_app" class="font-weight-bold"> Type de l'application</label>
			            <select id="type_app" class="form-control" required name="type_app" required>
			               @foreach ($types as $type)
			                  <option value="{{$type->id}}"> {{$type->designation}}</option>
			               @endforeach
			            </select>                              
		            </div>
		        	<div class="form-group">
		            	<label for="version" required class="font-weight-bold"> Version</label>
		            	<input type="text" name="version" class="form-control">                            
		            </div>
		            <div class="form-group">
		            	<label class="font-weight-bold"> Documentation</label> <br>
		            	<input type="file" accept=".pdf, .doc, .docx, .ppt, .pptx" name="documentation_np"  id="FileUpload1" class="file-upload-default">
			            <div class="input-group col-xs-12 custom">
			                <input type="text" class="form-control" disabled placeholder="Documentation" name="documentation_np" id="documentation_np" required>
			                <span class="input-group-append" id="spnFilePath" >
			                	<button class="file-upload-browse btn btn-upload" name="documentation_np" type="button" id="btnFileUpload"><i class="mdi mdi-upload"></i>Upload</button>
			                </span>
			            </div>
		            </div>
		        </form>
		        <button name="submit" type="submit" class="btn btn-dark mr-2" onclick="$('#demande').submit()"><i class="mdi mdi-send"></i>Envoyer</button>
		    </div>
	    </div>
	</div>
</div>
@endsection