<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title') - page</title>
        <meta charset="utf-8">
		<link rel="icon" href="images/sticon.png" type="image/png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/bootstrap/4.5.0/css/bootstrap.min.css') }}">
        <script type="text/javascript" src="{{ asset('/js/jquery-3.5.1.min.js') }}"></script>
        @stack('head')
    </head>
    <body>  
        <div class="container">
            <header>
                <x-banneradvertisement />
                <div class="row">
                    <div class="col-md-12 col-lg-3 pr-0">
                        <a href="#">
                            <img src="{{ asset('/image/logo.jpg') }}"   class="header-logo" alt="Logo" />
                        </a>
                    </div>
                    <div class="col-md-12 col-lg-9" >
                        <div class="header-nav">
                            <a href={{url('/')}}  class="{{ (request()->is('/')) ? 'active' : '' }}"> Home</a>
                            <a class="{{ (request()->is('news-and-features')) ? 'active' : '' }}" href="{{url('news-and-features')}}">News&Features</a>
                            <a href="discoveries.php">Discoveries&Innovations</a>
                            <a href="discoveries.php">Applications&Impacts</a>
                            <a href="discoveries.php">Science&Society</a>
                            <a href="the-scitech-journal.php">TheScitechJournal</a>
                        </div>
                    </div>
                </div> 
            </header>
        </div>
		<div class="bottom-line"></div>
		<div class="clearfix pt-1"></div>
        <div class="container">
            <div class="row">
                 @yield('content')
            </div>
        </div>
		<div class="container-fluid pr-0 pl-0">
            <footer>
                <div class="footer-menu">
                  <a href="#">Home</a>
                  <a href="#">About</a>
                  <a href="#">Subscribe</a>
                  <a href="#">Advertise</a>
                  <a href="#">Contact</a>
                </div>
                <h4>Footer Message</h4>
            </footer>
        </div>
        <script src="{{ asset('/css/bootstrap/4.5.0/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/custom.js') }}"></script>
    </body>
</html>
