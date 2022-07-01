<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


</head>
<body>
<div class="container"style="width: 400px">

    @if($errors->any())
        <div class="alert alert-danger">
           <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                     <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="text-center" style="margin-top: 20px">
            <h3>LogIn</h3>
            <hr>
        </div>
            <form action="{{route('login-user')}}" method="POST">
                @csrf

                   @if($message = Session::get('success'))
                      <div class="alert alert-success">
                          <p>{{$message}}</p>
                      </div>
                   @endif

                   @if($message = Session::get('fail'))
                      <div class="aler alert-danger">
                        <p>{{$message}}</p>
                      </div>
                   @endif

                <div class="form-group">
                 <label for="email">E-Mail:</label>
                     <input type="email" class="form-control" placeholder="Enter Your Email" name="email" value="">
                        </div>
                     <br>
                <div class="form-group">
                 <label for="password">Password:<a href="#" style="margin-left: 170px">Forget Password?</a></label>
                   <input type="password" class="form-control" placeholder="Enter Your Password" name="password" value="">
                        </div>
                                 <br>
                        <p>You Need To Register First? Click <a href="register">Here</a></p>

                        <div class="form-group">
                            <button class="btn btn-block btn-primary" type="submit">Login</button>
                        </div>

            </form>

    </div>
</div>
</body>
</html>
