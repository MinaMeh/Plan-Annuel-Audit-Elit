@extends('layouts.master')
@section('content')

    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center text-center error-page bg-light">
        <div class="row flex-grow">
          <div class="col-lg-7 mx-auto text-white">
            <div class="align-items-center d-flex flex-row">
              <div class="col-lg-6 text-lg-right pr-lg-4">
                <h1 class="display-1 mb-0 " style="color: black">!</h1>
              </div>
              <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
                <h2 style="color: black">Erreur!</h2>
                <h3 class="font-weight-light" style="color: black">Aucun plan en cours</h3>
              </div>
            </div>
            @if(auth()->check())
            <div class="row mt-5">
              <div class="col-12 text-center mt-xl-2">
                <a class="text-white font-weight-medium" href="/plans" style="color: black">Créer un plan</a>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  


@endsection