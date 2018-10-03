@extends('layouts.client')
@section('client')
<div class="row ">
<div class="col-md-8 grid-margin stretch-card">
  <div class="card card1 ">
    <div class="card-body">
      <h3 class="card-title">Veuillez saisir les informations suivantes :</h3>
      <form method="post" action="/demandsNPStep1" id="demandeNP" enctype="multipart/form-data">
          {{csrf_field()}}
                      @include('errors.errors')

          <div class="form-group">
            <label for="nature_client_np" class="font-weight-bold"> Nature du client</label>
              <select class="form-control" name="nature_client_np" id="nature_client_np" required>
                <option value="-1" selected></option>
                <option value="Interne"> Interne</option>
                <option value="Externe"> Externe</option>
              </select>                              
          </div>
          <div class="form-group collapse" id="INT_np" >
            <label for="client_np" class="font-weight-bold"> Département</label>
            <select class="form-control" name="client_np" id="client_np" required>
              <option value="-1" selected></option>
              @foreach ($departements as $departement)
                @if ($departement->nature=='Interne')
                 <option value="{{$departement->designation}}">{{$departement->designation}} </option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="form-group collapse" id="EXT_np">
            <label for="client_np" class="font-weight-bold"> Département</label>
            <select type="text" name="client_npe" class="form-control" id="client_npe">
              <option value="-1" selected></option>
              @foreach ($departements as $departement)
                @if ($departement->nature=='Externe')
                 <option value="{{$departement->designation}}">{{$departement->designation}} </option>
                @endif
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="nom_app_np" class="font-weight-bold"> Nom de l'application</label>
            <input type="text" name="nom_app_np" class="form-control" required>                             
          </div>
          
          <div class="form-group">
              <label  class="font-weight-bold"> Date prévue pour passage en production</label>
              <input class="form-control" type="date" name="date_prevu_prod_np" required>
          </div>

          <div class="form-group">
              <label for="techs_np" class="font-weight-bold"> Technologies utilisées</label>
                <div class="form-check form-check-flat">
                    @foreach ($technologies as $technologie)
                        <div class="form-check">
                            <label class="form-check-label">
                              <input type="checkbox" name="tech_np[]" value="{{$technologie->id}}" >{{'  '.$technologie->designation.'         '}}                                              
                            </label>
                        </div> 
                      @endforeach
                      <div class="form-check">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="tech" id="autre"> Autres
                          </label>
                      </div>
                      <input class="form-control collapse" type="text" name="autre_tech" id="autre_tech">
                </div>
          </div>
          <div class="form-group">
            <label for="type_app_np" class="font-weight-bold"> Type de l'application</label>
              <select id="type_app_np" class="form-control" name="type_app_np" required>
                @foreach ($types as $type)
                  <option value="{{$type->id}}"> {{$type->designation}}</option>
                @endforeach
              </select>                              
          </div>
          <div class="form-group">
            <label for="version_np" class="font-weight-bold"> Version</label>
            <input type="text" name="version_np" class="form-control">                            
          </div>
          <div class="form-group">
            <label for="chef_projet_np" class="font-weight-bold" > Chef du projet</label>
            <input type="text" class="form-control" required name="chef_projet_np" id="chef_projet_np">                            
          </div>
          <div class="form-group">
            <label for="email_chef_projet_np" class="font-weight-bold"> Chef du projet -Email-</label>
            <input type="email" class="form-control" required name="email_chef_projet_np" id="email_chef_projet_np">                            
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
          
          <button name="submit" type="submit" class="btn btn-dark mr-2" onclick="$('#demandeNP').submit()"><i class="mdi mdi-send"></i>Envoyer</button>
        </form>
    </div>
  </div>
</div>
</div>
@endsection
