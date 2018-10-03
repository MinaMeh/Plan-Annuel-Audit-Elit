@extends('layouts.master')
@section('content')
<div class="row ">
  <div class="col-md-8 grid-margin stretch-card">
    <div class="card card1 ">
      <div class="card-body">
        <h3 class="card-title">Veuillez saisir les informations suivantes :</h3>
        <form class="forms-sample" method="post" action="/previsions/modifier/{{$application->id}}">
            {{csrf_field()}}
            @include('errors.errors')
            <div class="form-group">
              <label for="app_name" class="font-weight-bold"> Nom de l'application</label>
              <input type="text" class="form-control" name="app_name" id="app_name" placeholder="Nom de l'application" value="{{$application->nom}}" required>
            </div>
            <div class="form-group">
              <label for="nature_client" class="font-weight-bold"> Nature du client</label>
              <select class="form-control" name="nature_client">
                <option value="Interne" <?php  if ($application->nature_client=='Interne') echo "selected";?>> Interne </option>
                <option value="Externe" <?php  if ($application->nature_client=='Externe') echo "selected";?>> Externe </option>
              </select>
            </div>
            <div id="clientInfo">
              <div class="form-group" id="INT">
                <label for="client" class="font-weight-bold"> Département</label>
                <input class="form-control" type="text" name="client" value="{{$application->client}}" required  >
              </div>
            </div>
            <div class="form-group">
              <label for="app_name" class="font-weight-bold"> Date prévue pour passage en production</label>
              <input class="form-control" type="date" name="date_prevu_prod" value="{{$application->date_prevu_prod}}" >  
            </div>
            <div class="form-group">
              <label for="created" class="font-weight-bold"> Technologies utilisées</label>
                <div class="form-check form-check-flat">
                  @foreach ($technologies as $technologie)
                    @if (in_array($technologie->designation,$application->technologies()->pluck('designation')->toArray(),true))
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" name="tech[]" checked value="{{$technologie->id}}" >{{'  '.$technologie->designation.'         '}}                                              
                        </label>
                      </div> 
                    @else  
                      <div class="form-check">
                        <label class="form-check-label">
                          <input type="checkbox" name="tech[]"  value="{{$technologie->id}}" >{{'  '.$technologie->designation.'         '}}
                        </label>
                      </div> 
                    @endif
                    @endforeach
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="autre" id="autre" <?php  if ($application->autre_tech) echo "checked";?>> Autres
                      </label>
                    </div>
                    <input class="form-control collapse <?php  if ($application->autre_tech) echo "show";?>" type="text" name="autre_tech" id="autre_tech" value="{{$application->autre_tech}}">
                </div>
            </div>
            <div class="col-md-6 offset-md-6" >
              <button name="submit" type="submit" class="btn btn-success mr-2" id="ajoutPlan"><i class="mdi mdi-calendar-plus"></i>Sauvgarder</button>
              <button class="btn btn-secondary"><i class="mdi mdi-close"></i><a href="/previsions"> Annuler</a></button> 
            </div>
          </form>
      </div>
    </div>
  </div>
</div>
@endsection