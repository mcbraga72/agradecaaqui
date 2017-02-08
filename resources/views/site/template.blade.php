<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="@yield('keywords')">
        <meta name="author" content="@yield('author')">
        <meta name="description" content="@yield('description')">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="csrf-token" content="{{{ csrf_token() }}}">
        <title>@yield('title', 'Agradeça Aqui')</title>
        <link rel="stylesheet" property="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" property="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ URL::asset('css/site.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/reset.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-social.css') }}">
        <link rel="stylesheet" property="stylesheet" href="assets/css/app.css">    
    </head>
    <body>
        <header class="main-header">
            <nav class="navbar navbar-default navbar-static-top">                
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}" title="">HOME</a></li>
                    <li><a href="{{ url('/quem-somos') }}" title="">QUEM SOMOS</a></li>
                    <li><a href="{{ url('/regras') }}" title="">REGRAS</a></li>
                    <li><a href="{{ url('/contato') }}" title="">CONTATO</a></li>
                    <li><a href="{{ url('/login') }}" title="">LOGIN</a></li>
                </ul>
            </nav>
        </header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0 nopadding">
                    <img src="{{ URL::to('/') }}/images/banner.png" width="100%" />    
                </div>
            </div>
        </div>
        @yield('content')
        <footer class="nopadding">
            <img src="{{ URL::to('/') }}/images/footer.jpg" width="100%" />
        </footer>                                    
        <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="assets/js/app.js"></script>
    </body>
</html>
