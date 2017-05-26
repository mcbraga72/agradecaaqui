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
        
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <link rel="stylesheet" href="/css/site.css">
        <link rel="stylesheet" href="/css/reset.css">
        <link rel="stylesheet" href="/css/bootstrap-social.css">
        <link rel="stylesheet" href="/css/vendor/bootstrap-chosen/bootstrap-chosen.css">

        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/js/site.js"></script>

    </head>
    <body id="createEnterprise">
        <header class="main-header">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>          
                    </div>
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            @if (Auth::guest())
                                <li><a href="{{ url('/') }}" title="">HOME</a></li>
                                <li><a href="{{ url('/apoiadores') }}" title="">APOIADORES</a></li>
                                <li><a href="{{ url('/quem-somos') }}" title="">QUEM SOMOS</a></li>
                                <li><a href="{{ url('/contato') }}" title="">CONTATO</a></li>
                                <li><a href="{{ url('/entrar') }}" title="">ENTRAR</a><i class="fa fa-3x fa-user-circle-o" aria-hidden="true"></i></li>
                            @else
                                <li><a href="{{ url('/') }}" title="">HOME</a></li>
                                <li><a href="{{ url('/apoiadores') }}" title="">APOIADORES</a></li>
                                <li><a href="{{ url('/quem-somos') }}" title="">QUEM SOMOS</a></li>
                                <li><a href="{{ url('/contato') }}" title="">CONTATO</a></li>
                                <li><a href="{{ url('/app') }}" title="">ÁREA DO CLIENTE</a><i class="fa fa-3x fa-user-circle-o" aria-hidden="true"></i></li>
                                <li class="dropdown app-dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <img src="{{ Auth::user()->photo }}" style="border-radius: 50%;" /><span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li class="caret-dropdown">
                                            <a href="{{ url('app/usuario/' . Auth::user()->id . '/edit') }}">Perfil</a>                                    
                                            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                                        </li>
                                    </ul>
                                </li>
                            @endif    
                        </ul>
                    </div>
                </div>
            </nav>            
        </header>        
        @yield('content')
        <footer class="nopadding">        
            <img src="{{ URL::to('/') }}/images/footer.png" width="100%" />
        </footer>                                    
        <script type="text/javascript">
            $(document).ready(function () {
                var url = window.location;
                $('ul.nav a[href="'+ url +'"]').parent().addClass('active-menu');
                $('ul.nav a').filter(function() {
                    return this.href == url;
                }).parent().addClass('active-menu');
            });
        </script> 
    </body>
</html>
