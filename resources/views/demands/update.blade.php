@extends('layouts.master')
@section('content')
<div class="row ">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card card1 ">
          	<div class="card-body">
	            <form method="post" action="/demands/modifier/{{$demande->id}}" id="demande_update" enctype="multipart/form-data">
	            {{csrf_field()}}
	            @include('errors.errors')
	                <div class="form-group">
	                  <label for="nom_app" class="font-weight-bold"> Nom de l'application</label>
	                  <input type="text" class="form-control" name="nom_app" id="nom_app" value="{{$demande->application->nom}}" placeholder="Nom de l'application" required>
	                  <input type="text" id="apps_list" name="app_id" hidden value="{{$demande->application->id}}">
	                </div>
	                <div class="form-group">
	                  <label for="chef_projet" class="font-weight-bold"> Chef du projet</label>
	                  <input type="text" class="form-control" name="chef_projet" required id="chef_projet" value="{{$demande->application->chef_projet}}">
	                </div>
	                <div class="form-group">
	                    <label for="chef_projet" class="font-weight-bold"> chef du projet -Email-</label>
	                    <input class="form-control" type="email" required name="email_chef_projet" id="email_chef_projet" value="{{$demande->application->email_chef_projet}}">
	                </div>
	                <div class="form-group">
	                    <label for="type_app" class="font-weight-bold"> Type de l'application</label>
	                    <select id="type_app" class="form-control" name="type_app" required>
	                      @foreach ($types as $type)
	                        
	                        <option  <?php  if ($demande->application->type_id==$type->id) echo "selected";?> value="{{$type->id}}"> {{$type->designation}}</option>
	                      @endforeach
	                    </select> 
	                </div>
	                <div class="form-group">
	                  <label for="version" class="font-weight-bold"> Version</label>
	                  <input type="text" class="form-control" required name="version" value="{{$demande->application->version}}">
	                </div>
	                <div class="form-group">
	                    <label class="font-weight-bold"> Documentation</label> <br>
	                    <input type="file" name="documentation" accept=".pdf, .doc, .docx, .ppt, .pptx" id="FileUpload1" class="file-upload-default">
	                    <div class="input-group col-xs-12 custom">
	                      <input type="text" class="form-control" disabled placeholder="Documentation" name="documentation" id="documentation"  required>
	                      <span class="input-group-append" id="spnFilePath" >
	                        <button class="file-upload-browse btn btn-upload" name="documentation" type="button" id="btnFileUpload"><i class="mdi mdi-upload"></i>Upload</button>
	                      </span>
	                    </div>
	                  </div>
	                  <div class="form-group">
	                      <label class="font-weight-bold"> Serveurs de l'application</label>
	                      <div class="table-responsive">
	                            <table class="table table-bordered">
	                            <thead >
	                                <tr>  
	                                    <th class="text-center font-weight-bold"> Addresse IP</th>
	                                    <th class="text-center font-weight-bold"> Port</th>
	                                    <th class="text-center font-weight-bold"> Utilisateur</th>
	                                    <th class="text-center font-weight-bold"> Mot de passe</th>
	                                    <th class="text-center font-weight-bold"> Utilisateur SSH</th>
	                                    <th class="text-center font-weight-bold"> Mot de passe SSH</th>
	                                    <th class="text-center font-weight-bold"> Technologie</th>
	                                    <th class="text-center font-weight-bold"> Action</th>
	                                </tr>
	                            </thead>
	                            <tbody id="appservers">
	                            @foreach ($demande->application->serveurs as $serveur)
		                            <tr>
		                              <td class="text-center"> {{$serveur->addresse_ip}}</td>
		                              <td class="text-center"> {{$serveur->port}}</td>
		                              <td class="text-center"> {{$serveur->user}}</td>
		                              <td class="text-center"> {{$serveur->password}}</td>
		                              <td class="text-center"> {{$serveur->user_ssh}}</td>
		                              <td class="text-center"> {{$serveur->password_ssh}}</td>
		                              <td class="text-center"> {{$serveur->tech}}</td>
		                              <td class="text-center"> <button type="button" class="btn btn-danger btn-sm btn_del" name="btn_del" id="btn_del" data-id8="{{$serveur->id}}"><span class="fa fa-minus-circle"></button></td>
		                            </tr>
	                            @endforeach 
		                            <tr contenteditable='true'>
	                                  <td class="text-center addresse_ip" id="addresse_ip"></td>
	                                  <td class="text-center port" id="port" ></td>
	                                  <td class="text-center user" id="user_server" ></td>
	                                  <td class="text-center password" id="password_server" ></td>
	                                  <td class="text-center user_ssh" id="user_ssh" ></td>
	                                  <td class="text-center password_ssh" id="password_ssh" ></td>
	                                  <td class="text-center tech" id="tech" ></td>
	                                  <td class="text-center">
	                                      <button type="button" name="btn_add" class="btn btn-success btn-sm" id="btn-info" 
	                                          onclick="addUserServer($('#apps_list').val())">
	                                          <span class="mdi mdi-plus"></span>
	                                      </button>
	                                  </td>
		                            </tr>  
	                            </tbody>
	                            </table> 
	                      </div>
	                  </div>
	                  <div class="form-group">
	                    <label class="font-weight-bold"> Utilisateurs de l'application</label>
	                    <div class="table-responsive">
	                      <table class="table table-bordered">
	                      <thead >
	                          <tr>  
	                            <th class="text-center font-weight-bold"> Utilisateur</th>
	                            <th class="text-center font-weight-bold"> Mot de passe</th>
	                            <th class="text-center font-weight-bold"> Rôle</th>
	                            <th class="text-center font-weight-bold"> Action</th>
	                          </tr>
	                      </thead>
	                      <tbody id="appusers">
	                        @foreach ($demande->application->appusers as $appuser)
	                          <tr>
	                            <td class="text-center"> {{$appuser->username}}</td>
	                            <td class="text-center"> {{$appuser->password}}</td>
	                            <td class="text-center"> {{$appuser->username}}</td>
	                            <td class="text-center"> <button type="button" class="btn btn-danger btn-sm btn_delete" name="btn_delete" id="btn_delete" data-id4="{{$appuser->id}}"><span class="fa fa-minus-circle"></button></td>
	                          </tr>
	                        @endforeach
	                          <tr contenteditable='true'>
	                            <td class="text-center username" id="user"></td>
	                            <td class="text-center password" id="password"></td>
	                            <td class="text-cente role" id="role"></td>
	                            <td class="text-center">
	                                <button type="button" name="btn_add" class="btn btn-success btn-sm" id="btn-info" 
	                                    onclick="addUserApp($('#apps_list').val())">
	                                    <span class="mdi mdi-plus"></span>
	                                </button>
	                            </td>
	                          </tr>
	                      </tbody>
	                      </table> 
	                    </div>
	                  </div>
	              </form>
              	<button name="submit" type="submit" class="btn btn-success mr-2" onclick="$('#demande_update').submit()"><i class="mdi mdi-content-save"></i>Sauvgarder</button>
              	   </form>
              	<a href="/demandes/{{$demande->id}}" class="btn btn-secondary mr-2" onclick="$('#demande_update').submit()"><i class="mdi mdi-close"></i>Annuler</a>
            </div>
        </div>
    </div>
</div>
@endsection
