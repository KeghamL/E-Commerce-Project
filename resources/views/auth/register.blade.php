<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>
    <div class="container" style="width: 400px">
        @if ($errors->any())

            <div class="alert alert-danger">

                <strong>Whoops!</strong> There were some problems with your input.<br><br>

                <ul>

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif
        <div class="row">
            <div class="text-center" style="margin-top: 20px">
                <h3>Registration</h3>
                <hr>
            </div>
            <form action="{{ route('register-user') }}" method="POST">
                @csrf
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="form-group">
                    <label for="fname">FirstName:</label>
                    <input type="text" class="form-control" placeholder="Enter Your FirstName" name="fname"
                        value="{{ old('fname') }}">
                </div>

                <div class="form-group">
                    <label for="lname">LastName:</label>
                    <input type="text" class="form-control" placeholder="Enter Your LastName" name="lname"
                        value="{{ old('lname') }}">
                </div>

                <div class="form-group">
                    <label for="email">E-Mail:</label>
                    <input type="email" class="form-control" placeholder="Enter Your Email" name="email"
                        value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" placeholder="Enter Your Password" name="password"
                        value="{{ old('password') }}">
                </div>

                <div class="form-group">
                    <label for="repassword">Confirm Password:</label>
                    <input type="password" class="form-control" placeholder="Repeat Your Password" name="repassword"
                        value="{{ old('repassword') }}">
                </div>

                <div class="form-group">
                    <label for="birthday">Birthday:</label>
                    <input type="date" class="form-control" placeholder="Enter Your Birthday" name="birthday"
                        value="{{ old('birthday') }}">
                </div>


                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <input type="radio" name="gender" value="male">Male
                    <input type="radio" name="gender" value="female">Female
                </div>

                <P>Your Registered Allready? LogIn<a href='login'>Here</a></P>

                <div class="form-group">
                    <button class="btn btn-block btn-primary" type="button">Register</button>
                </div>
            </form>

        </div>
    </div>
</body>

</html>
