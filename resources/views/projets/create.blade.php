@extends ('layouts.master')
@section('content')
<div class="row">                                        
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h1 style="text-align: center;"> Nom de l'application:  {{$projet->application->nom}}</h1>
        <div style="text-align: center">
          Technologies utilisées:
          @foreach ($projet->application->technologies as $tech)
                  <span class="badge badge-primary">{{$tech->designation}} </span>
          @endforeach
          Type: <span class="badge badge-primary">{{$projet->application->type->designation}}</span>
          Date de réception: <span class="badge badge-primary" >{{$projet->date_reception}}</span>
        </div>
      </div><hr>
      <div class="row">   
        <div class="col-md-8 offset-md-2">
          <form method="post" action="/projet/create/{{$projet->id}}">
            {{csrf_field()}}
            @include('errors.errors')
            <div class="form-group">
              <label for="procedure" class="font-weight-bold"> Appliquer la Procédure: </label>
              <select class="form-control" name="procedure" required>
                @foreach ($procedures as $procedure)
                  <option value="{{$procedure->id}}">{{$procedure->designation}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="trimestre"  class="font-weight-bold"> Affecter au trimestre:</label>
              <select class="form-control" name="trimestre" required>
                <option selected>1</option>
                <option>2</option>
                <option >3</option>
                <option >4</option>
              </select>
            </div>
            <div class="form-group">
              <label for="date_debut_audit"  class="font-weight-bold"> Date Début d'audit:</label>
              <input class="form-control" type="date" name="date_debut_audit" value="">
            </div>
            <div class="form-group">
              <label  class="font-weight-bold"> Affecter aux pentesters:</label> <br>
              @foreach ($users as $user)
              <div class="form-check form-check-flat">
                            <div class="form-check"> 
                              <label class="form-check-label">
                                <input type="checkbox" name="user[]" value="{{$user->id}}"  >{{'   '.$user->name}}
                              </label>
                            </div>
                           
                          </div>  
                     @endforeach
              </div> <br>
            <input type="submit" name="submit" value="confirmer" class="btn btn-success"><br><br>
                        </form>

        </div>
      </div>         
    </div>
  </div>     
</div>                
@endsection

