 <!DOCTYPE html>
 <html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=" Application Web pour la gestion de plan annuel des audits! ">
    <meta name="author" content="MEKIDECHE Imane & MEHERHERA Amina">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/styleLogin.css">
    <link rel="icon" type="/image/png" href="/img/Login.ico"/>
    <title> DSSD | Login form </title> 
</head>

<body>  
<div class="container">
    <div class="box">
        <form class="animate"  role="form" method="POST" action="{{ url('/password/email') }}"> 
            {{ csrf_field() }}
            <h2 class="font-weight-bold"> Reset password </h2>
            @if (session('status'))
               <div class="alert alert-success">
                  {{ session('status') }}
              </div>
            @endif
            <div class="inputbox{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type ="email" name="email" class="form-control"  value="{{ old('email') }}" required> 
                <label><i class="fas fa-user"></i> Email </label> 
                 @if ($errors->has('email'))
                    <span class="help-block">
                       <div class="alert alert-danger"><strong>{{ $errors->first('email') }}</strong></div>
                    </span>
                @endif
            </div>
            <input class="" type ="submit" name="" value="Send mail"> 
        </form>     
    </div>
</div>

</body>
</html>