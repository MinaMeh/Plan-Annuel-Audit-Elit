@extends('layouts.client')
@section('client')
<div class="row ">
<div class="col-md-8 grid-margin stretch-card">
  <div class="card card1 ">
    <div class="card-body">
      <h3 class="card-title">Veuillez saisir les informations suivantes :</h3>
      @include('errors.errors')
      <form method="post" action="/demandsNPStep2" id="demande" enctype="multipart/form-data">
          {{csrf_field()}}
                      @include('errors.errors')

          <input type="" hidden id="apps_list" value="{{$app->id}}" name="app_id">
          <div class="form-group">
            <label class="font-weight-bold">Serveurs de l'application</label>
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
                          <th> </th>
                      </tr>
                  </thead>
                  <tbody id="appservers">
                        <tr contenteditable='true'>
                            <td class="text-center addresse_ip" id="addresse_ip"  ></td>
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
          </div> <br>
          <div class="form-group">
            <label class="font-weight-bold"> Utilisateurs de l'application</label>
            <div class="table-responsive">
                <table class="table table-bordered">
                  <thead >
                      <tr>  
                          <th class="text-center font-weight-bold"> Utilisateur</th>
                          <th class="text-center font-weight-bold"> Mot de passe</th>
                          <th class="text-center font-weight-bold"> Rôle</th>
                          <th> </th>
                      </tr>
                  </thead>
                  <tbody id="appusers">
                        <tr contenteditable='true'>
                            <td class="text-center username"  id="user"></td>
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
          <button  class="btn btn-dark mr-2" id="Envoyer" >
              <i class="mdi mdi-send"></i>
              <a style="color:#fff;" href="/Client_demandes_NP"> Envoyer</a>
          </button>
          <button class="btn btn-secondary" type="submit" name="submit" onclick="$('#demande').submit()">
              <i class="mdi mdi-close"></i>Annuler
            </button> 
        </form>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
  $('#Envoyer').on('click',function(event){

    event.preventDefault();
    window.location.replace('/demandes');
      })
</script>
@endsection