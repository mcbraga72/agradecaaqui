<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="agradeça aqui agradecimento pessoas empresas">
        <meta name="author" content="Agradeça Aqui">
        <meta name="description" content="Aqui no nosso site você pode agradecer pessoas e empresas sempre que tiver vontade.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="csrf-token" content="{{{ csrf_token() }}}">
        <meta name="google-site-verification" content="Gupk_NevOJ8K4Gf-_Ep5EKtOhk7NkL4mAnLXB_HftdA" />

        <meta property="og:title" content="Agradeça Aqui" />
        <meta property="og:site_name" content="Agradeça Aqui" />
        <meta property="og:url" content="https://agradecaaqui.site" />
        <meta property="og:image" content="https://agradecaaqui.site/images/banner.png" />
        <meta property="og:description" content="Aqui no nosso site você pode agradecer pessoas e empresas sempre que tiver vontade." />
        <meta property="fb:app_id" content="184558058632813" />
        
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@agradecaaqui" />
        <meta name="twitter:title" content="Agradeça Aqui" />
        <meta name="twitter:description" content="Aqui no nosso site você pode agradecer pessoas e empresas sempre que tiver vontade." />
        <meta name="twitter:image" content="https://agradecaaqui.site/images/banner.png" />

        <title>Agradeça Aqui</title>
        <link rel="shortcut icon" href="images/logo.png" />
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/css/site.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/css/reset.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/css/bootstrap-social.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/css/vendor/bootstrap-chosen/bootstrap-chosen.css">

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{ URL::to('/') }}/js/site.js"></script>

    </head>
    <body id="createEnterprise" itemscope itemtype="https://schema.org/WebPage">
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
                                <li><a href="{{ url('/parceiros') }}" title="">PARCEIROS</a></li>
                                <li><a href="{{ url('/quem-somos') }}" title="">QUEM SOMOS</a></li>
                                <li><a href="{{ url('/blog/') }}" title="">BLOG</a></li>
                                <li><a href="{{ url('/contato') }}" title="">CONTATO</a></li>
                                <li><a href="{{ url('/entrar') }}" title="">ENTRAR</a><i class="fa fa-3x fa-user-circle-o" aria-hidden="true"></i></li>
                            @else
                                <li><a href="{{ url('/') }}" title="">HOME</a></li>
                                <li><a href="{{ url('/parceiros') }}" title="">PARCEIROS</a></li>
                                <li><a href="{{ url('/quem-somos') }}" title="">QUEM SOMOS</a></li>
                                <li><a href="{{ url('/blog/') }}" title="">BLOG</a></li>
                                <li><a href="{{ url('/contato') }}" title="">CONTATO</a></li>
                                <li><a href="{{ url('/app') }}" title="">ÁREA DO USUÁRIO</a><i class="fa fa-3x fa-user-circle-o" aria-hidden="true"></i></li>
                                <li class="dropdown app-dropdown">
                                    <a href="#" id="home" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <img src="{{ Auth::user()->photo }}" class="avatar" /><span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li class="caret-dropdown">
                                            <a href="{{ url('app/usuario/' . Auth::user()->id . '/edit') }}" class="item-menu-dropdown">PERFIL</a>
                                            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="item-menu-dropdown">SAIR</a>
                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="logout-form">{{ csrf_field() }}</form>
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
            <div class="col-lg-12 social-networks">
                <a href="https://www.facebook.com/agradecaaquii/" target="_blank"><img src="{{ URL::to('/') }}/images/facebook.png" alt="Perfil no Facebook" title="Perfil no Facebook" /></a>
                <a href="https://www.instagram.com/agradecaaqui/" target="_blank"><img src="{{ URL::to('/') }}/images/instagram.png" alt="Perfil no Instagram" title="Perfil no Instagram" /></a>
            </div>
            <img src="{{ URL::to('/') }}/images/footer.png" width="100%" alt="Rodapé - Agradeça Aqui" title="Rodapé - Agradeça Aqui" />
        </footer>                                    
        <script type="text/javascript">
            $(document).ready(function () {
                var url = window.location;
                $('ul.nav a[href="'+ url +'"]').parent().addClass('active-menu');
                $('ul.nav a').filter(function() {
                    return this.href == url;
                }).parent().addClass('active-menu');
            });
        
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-81385305-2', 'auto');
            ga('send', 'pageview');
        </script>
    </body>
</html>
