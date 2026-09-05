<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Custom Stylesheet -->
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <!-- ICONSCOUT CDN -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        <!-- GOOGLE FONT(MONTSERATE) -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,800;1,700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="{{ asset('js/main.js') }}"></script>
    </head>
    <body class="font-sans antialiased">
          <nav>
        <div class="container nav__container">
            <a href="" class="nav__logo">UNDEREMPLOYED</a>
            <ul class="nav__items">
                <li><a href="">Blog</a></li>
                <li><a href="">About</a></li>
                <li><a href="">Services</a></li>
                <li><a href="">Contact</a></li>
                <li><a href="">SignIn</a></li>
                <li class="nav__profile">
                    <div class="avatar">
                        <img src="">
                    </div>  
                    <ul>
                        <li><a href="">Dashboard</a></li>
                        <li><a href="">Logout</a></li>
                    </ul>
                </li>
            </ul>
            
            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>
   @yield('content')
      <footer>
        <div class="footer__socials">
            <a href="https://www.youtube.com/channel/UCvtrqmex9f7J9hxZfmhoHRw" target="_blank"><i class="uil uil-youtube"></i></a>
            <a href="https://www.instagram.com/_underemployed_/" target="_blank"><i class="uil uil-instagram-alt"></i></a>
            <a href="https://www.linkedin.com/in/nithin-a-06b946256/" target="_blank"><i class="uil uil-linkedin"></i></a> 
            <a href="" target="_blank"><i class="uil uil-facebook-f"></i></a> 
    
      
        </div>
        <div class="container footer__container">
            <article>
                <h4>Categotries</h4>
                <ul>
                    <li><a href="">Wild Life</a></li>
                    <li><a href="">Music</a></li>
                    <li><a href="">Movies</a></li>
                    <li><a href="">Travel</a></li>
                    <li><a href="">Science & Technology</a></li>
                    <li><a href="">Food</a></li>
                
                </ul>
            </article>
            <article>
                <h4>Support</h4>
                <ul>
                    <li><a href="">Online Support</a></li>
                    <li><a href="">Call Numbers</a></li>
                    <li><a href="">Emails</a></li>
                    <li><a href="">Social Support</a></li>
                    <li><a href="">Location</a></li>
                    <li><a href="">Food</a></li>
                </ul>
            </article>
    
            <article>
                <h4>Blog</h4>
                <ul>
                    <li><a href="">Safety</a></li>
                    <li><a href="">Repair</a></li>
                    <li><a href="">Recent</a></li>
                    <li><a href="">Popular</a></li>
                    <li><a href="">Categories</a></li>
                </ul>
            </article>
    
            <article>
                <h4>PermaLinks</h4>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">Blog</a></li>
                    <li><a href="">About</a></li>
                    <li><a href="">Services</a></li>
                    <li><a href="">Contact</a></li>
                    
                </ul>
            </article>
        </div>
    
        <div class="footer__copyright">
            <small>Copyright &copy; UnderEmployed</small>
        </div>
      </footer>
    </body>
</html>
