<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Agradeça Aqui | Admin</title>  
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ URL::asset('css/vendor/admin-lte.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/enterprise.css') }}">      
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <script src="//codeorigin.jquery.com/ui/1.10.2/jquery-ui.min.js"></script>
        <script src="{{ URL::asset('js/app.js') }}"></script>
        <script src="{{ URL::asset('js/vendor/adminlte/app.min.js') }}"></script>    
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <a href="#" class="logo"><span class="logo-lg"><b>Área da empresa</b> - Agradeça Aqui</span></a>
                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"><span class="sr-only">Toggle navigation</span></a>
                    <ul class="nav navbar-nav navbar-right" style="z-index: 1000000">
                    @if (Auth::guard('enterprises')->guest())
                        <li><a href="{{ url('/empresa/entrar') }}">Login</a></li>                        
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::guard('enterprises')->user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/empresa/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    <a href="{{ url('/empresa/perfil/' . Auth::guard('enterprises')->user()->id . '/editar') }}">Perfil</a>
                                    <form id="logout-form" action="{{ url('/empresa/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                                </li>
                            </ul>
                        </li>
                    @endif
                    </ul>
                </nav>
            </header>
            <aside class="main-sidebar">
                <section class="sidebar">
                    <ul class="sidebar-menu">      
                        <li><a href="{{ url('/empresa/perfil/' . Auth::guard('enterprises')->user()->id . '/editar') }}"><i class="fa fa-user"></i> <span>Perfil</span></a></li>
                        <li><a href="{{ url('/empresa/agradecimentos') }}"><i class="fa fa-heart"></i> <span>Agradecimentos</span></a></li>
                        <li><a href="{{ url('/empresa/relatorios') }}"><i class="fa fa-bar-chart"></i> <span>Relatórios</span></a></li>
                    </ul>
                </section>            
            </aside>
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>Painel Administrativo</h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        @yield('content')
                    </div>
                </div>
            </div>  
        </div>
    </body>
</html>
