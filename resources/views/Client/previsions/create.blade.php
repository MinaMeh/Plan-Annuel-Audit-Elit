
@extends('layouts.client')
@section('client')
<div class="row ">
  <div class="col-md-8 grid-margin stretch-card">
    <div class="card card1 ">
      <div class="card-body">
        <h3 class="card-title">Veuillez saisir les informations suivantes :</h3>
        <form class="forms-sample" method="post" action="/previsions">
            {{csrf_field()}}
                        @include('errors.errors')

            <div class="form-group">
              <label for="app_name" class="font-weight-bold"> Nom de l'application</label>
              <input type="text" class="form-control"  id="name_app" placeholder="Nom de l'application" name="app_name" required>
            </div>
            <div class="form-group">
              <label for="nature_client" class="font-weight-bold"> Nature du client</label>
                <select id="nature_client" class="form-control" name="nature_client" required>
                  <option selected value="-1"></option>
                  <option > Interne</option>
                  <option>Externe</option>
                </select>                            
            </div>
            <div id="clientInfo">
              <div class="form-group collapse"  id="INT">
                <label for="client" class="font-weight-bold"> Département </label>
                <select id="client" class="form-control" name="clientt" >
                  @foreach ($departements as $departement)
                  @if ($departement->nature=='Interne')
                   <option value="{{$departement->designation}}">{{$departement->designation}} </option>
                  @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group collapse"  id="EXT">
                <label for="client" class="font-weight-bold"> Département </label>
                <select id="client" class="form-control" name="client">
                  @foreach ($departements as $departement)
                  @if ($departement->nature=='Externe')
                   <option value="{{$departement->designation}}">{{$departement->designation}} </option>
                   @endif
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="font-weight-bold"> Date prévue pour passage en production</label>
              <input type="date" class="form-control"  id="date" placeholder="Date prévue" name="date_prevu_prod" required>
            </div>
            <div class="form-group">
              <label class="font-weight-bold"> Téchnologies utilisées</label> 
              <div class="form-check form-check-flat">
                @foreach ($technologies as $technologie)
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" name="tech[]" value="{{$technologie->id}}" >{{'  '.$technologie->designation.'         '}}
                  </label>
                </div>
                @endforeach 
              </div> 
               <div class="form-check form-check-flat">
              <div class="form-check"> 
                <label class="form-check-label">
                  <input type="checkbox" name="autre"  id="autre" >Autres
                </label>
              </div>
              <input class="form-control collapse " type="text" name="autre_tech" id="autre_tech" value="">
            </div> 
          </div>
            <div class="col-md-2 offset-md-9" >
            <button name="submit" type="submit" class="btn btn-dark mr-2" id="ajoutPrevision"><i class="mdi mdi-send"></i>Envoyer</button>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>
@endsection
