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
        <link rel="shortcut icon" href="images/logo.png" />
        <link rel="stylesheet" property="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" property="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ URL::asset('css/site.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/reset.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-social.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">            
    </head>
    <body>
        <header class="main-header">
            <nav class="navbar navbar-default navbar-static-top">                
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/app') }}" title="">HOME</a></li>
                    <li><a href="{{ url('/app/agradecimentos') }}" title="">AGRADECIMENTOS</a></li>
                    <li><a href="{{ url('/app/perfil') }}" title="">PERFIL</a></li>                    
                </ul>
            </nav>
        </header>        
        @yield('content')
        <footer class="nopadding">        
            <img src="{{ URL::to('/') }}/images/footer.png" width="100%" />
        </footer>                                    
        <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="{{ URL::asset('js/site.js') }}"></script>        
    </body>
</html>
