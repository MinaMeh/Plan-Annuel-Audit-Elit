 <!DOCTYPE html>
 <html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=" Application Web pour la gestion de plan annuel des audits! ">
    <meta name="author" content="MEKIDECHE Imane & MEHERHERA Amina">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" >
    <link rel="stylesheet" href="/css/styleLogin.css">
    <link rel="icon" type="/image/png" href="/img/Login.ico"/>
    <title> DSSD | Login form </title> 
</head>

<body> 
<div class="container"> 
    <div class="box">
        <form class="animate"  role="form" method="POST" action="{{ url('/password/reset') }}"> 
            {{ csrf_field() }}
             @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <input type="hidden" name="token" value="{{ $token }}">

            <h2> Reset password </h2>
            <div class="inputbox{{ $errors->has('email') ? ' has-error' : '' }}">
            <input type ="email" name="email" class="form-control"  value="{{ $email or old('email') }}" required> 
                <label><i class="fas fa-user"></i> Email </label>   
                 @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif  
            </div>
            <div class="inputbox{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" name="password">
                <label><i class="fas fa-user"></i> New Password </label>   
                 @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
             <div class="inputbox{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                <label><i class="fas fa-user"></i> Confirm Password </label>   
                 @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
            <input class="btn" type ="submit" name="" value="Reset Password"> 
        </form>     
    </div>
</div>
</body>
</html> 