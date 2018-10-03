<!DOCTYPE html>
 <html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=" Application Web pour la gestion de plan annuel des audits! ">
	<meta name="author" content="MEKIDECHE Imane & MEHERHERA Amina">
	    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" >

	<link rel="stylesheet" href="/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="/css/styleLogin.css">
	<link rel="icon" type="image/png" href="/img/Login.ico"/>
    <title> DSSD | Login form </title> 
</head>

<body>
	<div class="container">	
		<div class="box">
			<div class="imgcontainer">
				<img src="/img/user.png" alt="user" class="avatar">
				<a href="/" class="close" title="Fermer"> 
					<i class="mdi mdi-close-circle-outline"> </i>
				</a>
	        </div>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                   <h2> PENTESTER LOGIN </h2>
                   @if ($errors->has('name'))
                            <div class="alert alert-danger text-center">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                     @endif
                         @if ($errors->has('password'))
                                <div class=" alert alert-danger text-center">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif

                       <div class="inputbox {{ $errors->has('name') ? ' has-error' : '' }}">
			     	<input type ="text" name="name" value="{{ old('name') }}" required > 
					<label><i class="mdi mdi-account"></i> Nom utilisateur </label>		
				</div>
				  
				<div class="inputbox {{ $errors->has('password') ? ' has-error' : '' }}">
					<input type ="password"  name="password" value="" required> 
					<label><i class="mdi mdi-lock"></i> Mot de passe </label>			
				</div>
				 
				<input class="btn" type ="submit" name="" value="Login"> 
				<div class="container">
				  <label>
	                <input type="checkbox" checked="checked" name="remember"> Remember me
				  </label>
				   <a class="forgotPwd" href="{{ url('/password/reset') }}">Mot de passe oublié ?</a>			   
	            </div>
                        </div>

                    </form>
                </div>
	</div>

</body>
</html>
