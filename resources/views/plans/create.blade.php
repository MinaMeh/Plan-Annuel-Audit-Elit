@extends('layouts.master')
@section('content')
<div class="row ">
  <div class="col-md-8 grid-margin stretch-card">
    <div class="card card1 ">
      <div class="card-body">
        <h3 class="card-title">Veuillez saisir les informations suivantes :</h3>
        <form class="forms-sample" method="post" action="/plans" enctype="multipart/form-data">
            {{csrf_field()}}
            @include('errors.errors')
            <div class="form-group">
              <label for="app_name" class="font-weight-bold"> Nom du plan</label>
              <input type="text" required class="form-control" name="nom" id="nom" placeholder="Nom du plan" value="PlanAudit{{date('Y')}}">
            </div>
            <div class="form-group">
              <label for="nature_client" class="font-weight-bold"> Année</label>
              <input type="number" name="annee" required class="form-control" id="annee" placeholder="L'année ici" min='{{date('Y')}}' max='{{date('Y')+2}}'>
            </div>
            <div class="form-group">
              <label class="font-weight-bold"> Note</label>
              <input type="file" name="note" accept="application/pdf " id="FileUpload1" class="file-upload-default">
              <div class="input-group col-xs-12 custom">
                <input type="text" class="form-control" disabled placeholder="Upload une Note" name="note" id="note" required>
                <span class="input-group-append" id="spnFilePath" >
                  <button class="file-upload-browse btn btn-upload" type="button" id="btnFileUpload"><i class="mdi mdi-upload"></i>Upload</button>
                </span>
              </div>
            </div>
            <button name="submit" type="submit" class="btn btn-success mr-2" id="ajoutPlan"><i class="mdi mdi-calendar-plus"></i>Ajouter</button>
            <button class="btn btn-light"><i class="mdi mdi-calendar-remove"></i><a href="/plans"> Annuler</a></button> 
          </form>
      </div>
    </div>
  </div>
</div>
@endsection
