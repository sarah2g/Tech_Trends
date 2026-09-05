<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNDEREMPLOYED</title>
    <!-- CUSTOM STYLESHEET -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <!-- ICONSCOUT CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- GOOGLE FONT(MONTSERATE) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,800;1,700&display=swap" rel="stylesheet"> 
    <script src="{{ asset('js/main.js') }}"></script>
</head>
<body>


<section class="form__section">

    <div class="container form__section-container">
        <h2>Sign In</h2>
       
             <div class="alert__message success">

            <p>{{ $errors->first('email') }}</p>
            <p>{{ $errors->first('password') }}</p>
        </div>
       
       
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <input type="text" placeholder="Username or Email" name="email">
            <input type="password" placeholder=" Password" name="password">
            <button type="submit" class="btn">Sign in</button>
            <small>Don't have an account? <a href="{{ route('register') }}">Sign up</a></small>
        </form>
    </div>

</section>


</body>
</html>