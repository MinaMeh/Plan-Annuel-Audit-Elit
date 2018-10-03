<!DOCTYPE html>
<html>
<head>
    <title> Plan annuel des audits </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" >
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/style1.css">
    <link rel="stylesheet" href="/vendors/iconfonts/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
    <link rel="shortcut icon" href="/img/logo.png" />
   <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
      <script type="text/javascript" src="/bootstrap/js/bootstrap.min.js" ></script>

   
</head>

<body>
  <div class="container-scroller">
    @include('layouts.upnav')
    <div class="container-fluid page-body-wrapper">
       @include('layouts.leftnav') 
       <div class="main-panel">
         <div class="content-wrapper">
           @yield('content')
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