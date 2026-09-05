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
        <h2>Sign Up</h2>
        <div class="alert__message error">
            <p>{{ $errors->first('firstname') }}</p>
            <p>{{ $errors->first('lastname') }}</p>
            <p>{{ $errors->first('username') }}</p>
            <p>{{ $errors->first('email') }}</p>
            <p>{{ $errors->first('password') }}</p>
        </div>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <input type="text" placeholder="First Name " name="firstname">
            <input type="text" placeholder="Last Name" name="lastname">
            <input type="text" placeholder="Username" name="username">
            <input type="email" placeholder="Email" name="email">
            <input type="password" placeholder="Create Password" name="password">
            <input type="password" placeholder="Confirm Password" name="password_confirmation">
            <div class="form__control">
                <label for="avatar">User Avatar</label>
                <input type="file" id="avatar" name="avatar">
            </div>
            <button type="submit" class="btn">Sign Up</button>
            <small>Already have an Account? <a href="{{ route('login') }}">Sign in</a></small>
        </form>
    </div>

</section>


</body>
</html>