@extends('layouts.master')
@section('content')
<div class="row ">
  <div class="col-md-9 grid-margin stretch-card">
    <div class="card card1 ">
      <div class="card-body">
        <div class="row ">
          <div class="servicetitle">
            <h4 class="font-weight-bold"> {{$plan->nom}}</h4> 
          </div>
          @if ($plan->actuel)
          <div class=" col-md-2 offset-md-7"> 
            <a class="btn btn-inverse-danger btn-sm" href="/plans/cloturer/{{$plan->id}}"><i class="mdi mdi-close-network"></i>Cloturer</a>
          </div>
          @endif
        </div>
        <div class="line"></div>
        <div class="col-lg-1">
        <div class="btn-group" role="group" aria-label="Basic example">
          <a class="btn btn-secondary" href="/previsions/?plan={{$plan->id}}"><i class="mdi mdi-eye"></i> Voir réponses</a>
          <a class="btn btn-secondary" href="/demandes/?plan={{$plan->id}}"><i class="mdi mdi-eye"></i> Voir demandes</a>
          <a class="btn btn-secondary" href="/projets/?plan={{$plan->id}}"><i class="mdi mdi-eye"></i> Voir projets</a>
          <a class="btn btn-secondary" href="/statistiques/?plan={{$plan->id}}"><i class="mdi mdi-eye"></i> Voir Statistiques</a>
        </div>
        </div>
        <div class="line"></div>
      <form class="forms-sample" method="post" action="/plans/modifier/{{$plan->id}}"  enctype="multipart/form-data">
        {{csrf_field()}}
        @include('errors.errors')
        <div class="form-group ">
          <label for="nom" class="font-weight-bold"> Nom du plan</label>
          <input type="text" class="form-control"  name="nom" id="nom" placeholder="Nom du plan" value="{{$plan->nom}}" required >
        </div>
        <div class="form-group ">
          <label for="annee" class="font-weight-bold"> Année</label>
          <input type="number" name="annee" class="form-control" id="annee" placeholder="L'année ici" min="{{date('Y')}}" value="{{$plan->annee}}" required>
        </div>
        <div class="form-group">
          <label for="created" class="font-weight-bold"> Créé le </label>
          <input type="text" class="form-control" name="created" value="{{$plan->created_at}}" disabled placeholder="Date création" >
        </div>
        <div class="form-group">
          <label for="created" class="font-weight-bold"> Modifié le </label>
          <input type="text" class="form-control" name="created" value="{{$plan->updated_at}}" disabled placeholder="Date modification" >
        </div>
        <div class="form-group">
          <label for="created" class="font-weight-bold"> Etat</label>
          <div class="form-check form-check-flat">
            @if ($plan->actuel)
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="actuel" checked> Ouvert
              </label>
            </div> 
            @else  
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox"  name="actuel" class="form-check-input"> Ouvert
              </label>
            </div> 
            @endif
        </div>
        </div>
        <div class="form-group">
          <label class="font-weight-bold"> Note</label> <br>
          <label> Afficher la note <a href="/plans/note/{{$plan->id}}">Note</a> ici.</label> 
          <input type="file" name="note" accept="application/pdf" id="FileUpload1" class="file-upload-default">
          <div class="input-group col-xs-12 custom">
            <input type="text" class="form-control" accept=".pdf" disabled placeholder="Changer la note" name="note" id="note" required>
            <span class="input-group-append" id="spnFilePath" >
              <button class="file-upload-browse btn btn-upload" name="note" type="button" id="btnFileUpload"><i class="mdi mdi-upload"></i>Upload</button>
            </span>
          </div>
        </div>
          <button name="submit" type="submit" class="btn btn-success mr-2" id="savePlan"><i class="mdi mdi-content-save"></i>Sauvgarder</button>
          <button class="btn btn-light"><i class="mdi mdi-calendar-remove"></i><a href="/plans"> Annuler</a></button> 
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
