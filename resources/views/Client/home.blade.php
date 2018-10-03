@extends('layouts.client')
@section('client')
<div class="row">                                        
    <div class="col-lg-6 offset-md-2 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              Pour afficher la note du plan annuel de l'année en cours cliquez sur:
              <a class="nav-link" href=""> 
                <i class="menu-icon mdi mdi-note"></i>
                <span class="menu-title"> Voir la note</span>
              </a>
            Pour envoyer les demandes d'audits prévus pour l'année cliquer sur :
              <a class="nav-link" href="/Client_previsions_create"> 
                <i class="menu-icon mdi mdi-calendar-text"></i>
                <span class="menu-title"> Prévision</span>
              </a>
            Pour envoyer une demande d'audit planifiée cliquée sur:
                  <a class="nav-link" href=""> <i class="menu-icon mdi mdi-send"></i>Envoyer une demande -> Demande planifiée</a>
                Pour envoyer une demande d'audit non planifiée cliquée sur:
                  <a class="nav-link" href=""><i class="menu-icon mdi mdi-send"></i>Envoyer une demande -> Demande non planifiée</a>



            </div>
        </div>
    </div>
 </div>



@endsection