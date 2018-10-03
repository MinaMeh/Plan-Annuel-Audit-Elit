<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=" Application Web pour la gestion de plan annuel des audits! ">
    <meta name="author" content="MEKIDECHE Imane & MEHERHERA Amina">
    <link rel="icon" type="/image/png" href="/img/logo.png">
    <link rel="stylesheet" href="/css/styleAcc.css">
    <title> DSSD | Plan annuel des audits </title> 
</head>

<body>
  <header class="headerAcc">
    <div class="headerAcc__text-box"> 
       <h1 class="heading-primary"> 
          <span class="heading-primary--main">Plan Annuel Des Audits</span>
       </h1>
       @if (auth()->check())
        <a type="button" id="btn-pentester" href="/plans" class="btnAcc btnAcc--white btnAcc--animated ">Pentester</a>
       @else
        <a type="button" id="btn-pentester" href="/login" class="btnAcc btnAcc--white btnAcc--animated ">Pentester</a>
       @endif
        <a type="button" id="btn-client" href="/client" class="btnAcc btnAcc--white btnAcc--animated ">Client</a>
    </div>
  </header>
</body>
</html>