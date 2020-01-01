<!DOCTYPE html>
<html>
<head>
    <title> Plan annuel des audits </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" >
    <link rel="stylesheet" href="vendors/iconfonts/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">    
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/logo.png" />
    <link rel="stylesheet" type="text/css" href="/css/style1.css">
     <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
      <script type="text/javascript" src="/bootstrap/js/bootstrap.min.js" ></script>

</head>
<body>
  <div class="container-scroller">
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="/">
          <img src="/img/logoApp.png" alt="logo" />  
        </a>       
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-right">
          <a class="logout font-weight-bold" href="#"> Utilisateur : Client</a>
        </ul>
    </div>
    </nav>

    <?php 
      $plan=App\Plan::where('actuel',1)->first()
     ?>
    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <a class="mg-left" id="sidebarCollapse"><i class="menu-icon mdi mdi-chevron-double-left mdi-24px" id="arrow"></i></a>

        <ul class="nav mr-auto">
         
            <li class="nav-item">
            <a class="nav-link" href="/plans/note/{{$plan->id}}"> 
              <i class="menu-icon mdi mdi-note mdi-24px"></i>
              <span class="menu-title-sm"> Voir la note</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/Client_previsions_create"> 
              <i class="menu-icon mdi mdi-calendar-text mdi-24px"></i>
              <span class="menu-title-sm"> Prévision</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-send mdi-24px"></i>
              <span class="menu-title-sm">Envoie des demandes </span> 
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link text-center" href="/Client_demandes_create"> Demande planifiée</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-center" href="/Client_demandes_NP"> Demande non planifiée</a>
                </li>
              </ul>
            </div>
          </li>
        
        </ul>
     </nav>
      <div class="main-panel">
        <div class="content-wrapper">
           @yield('client')
       </div>
      </div> 
    </div>       
  </div>

 <script type="text/javascript" src="/js/ajax.js"></script>
  <script type="text/javascript" src="/js/functions.js"></script>

  <script type="text/javascript" src="/js/script.js"></script>
  <script src="/vendors/js/vendor.bundle.base.js"></script>
  <script src="/vendors/js/vendor.bundle.addons.js"></script>
  <script src="/js/misc.js"></script>
  <script src="/js/scriptAdded.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {
      $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        if ($(this).hasClass('active'))
          $('#arrow').attr('class', 'mdi mdi-chevron-double-left mdi-24px');
        else
          $('#arrow').attr('class', 'mdi mdi-chevron-double-right mdi-24px');
          $(this).toggleClass('active');
          $('.main-panel').toggleClass('active');
      });
    });
  </script>
</body>
</html>