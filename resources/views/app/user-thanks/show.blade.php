<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title', 'Agradeça Aqui')</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="@yield('keywords')">
        <meta name="author" content="@yield('author')">
        <meta name="description" content="Agradeça Aqui - Plataforma de agradecimentos on-line">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta id="csrf-token" name="csrf-token" content="{{{ csrf_token() }}}">

        <!-- Open Graph data -->
        <meta property="og:title" content="Agradeça Aqui" />
        <meta property="og:type" content="website" />
        @foreach($userThanks as $userThank)
        <meta property="og:url" content="{{ 'http://agradecaaqui.herokuapp.com/app/agradecimento-empresa/' . $userThank->hash }}" />
        @endforeach        
        <meta property="og:image" content="http://agradecaaqui.herokuapp.com/images/banner.png" />
        <meta property="og:description" content="Faça seu agradecimento em nossa plataforma!" />
        <meta property="og:site_name" content="Agradeça Aqui" />
        <meta property="fb:app_id" content="752484724908381" />

        <!-- Twitter Card data -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@agradecaaqui">
        <meta name="twitter:creator" content="@agradecaaqui">
        <meta name="twitter:title" content="Agradeça Aqui">
        <meta name="twitter:description" content="Faça seu agradecimento em nossa plataforma!">
        <meta name="twitter:image" content="http://agradecaaqui.herokuapp.com/images/banner.png">
        
        <link rel="shortcut icon" href="images/logo.png" />
        <link rel="stylesheet" property="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" property="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ URL::asset('css/site.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/reset.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-social.css') }}">
        <link rel="stylesheet" href="css/vendor/bootstrap-chosen/bootstrap-chosen.css">
        <script src="https://apis.google.com/js/platform.js" async defer></script>
    </head>
    <body>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8&appId=752484724908381";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <script>window.twttr = (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0],
                t = window.twttr || {};
            if (d.getElementById(id)) return t;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js, fjs);

            t._e = [];
            t.ready = function(f) {
                t._e.push(f);
            };

            return t;
        }(document, "script", "twitter-wjs"));</script>
        <header class="main-header">
            <nav class="navbar navbar-default navbar-static-top">                
                <ul class="nav navbar-nav">
                    <li>
                        <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                            <li><a href="{{ url('/entrar') }}">Login</a></li>
                            <li><a href="{{ url('/cadastro') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <img src="{{ Auth::user()->photo }}" /><span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="caret-dropdown">
                                        <a href="{{ url('/app/agradecimentos') }}" title="">Agradecimentos</a>
                                        <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                        <a href="{{ url('/app/perfil') }}">Perfil</a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        </ul>
                    </li>    
                </ul>
            </nav>
        </header>        
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 home">
                    <img class="logo-login" src="{{asset('images/logo.png')}}"" />
                    <h1 class="support">Compartilhar agradecimento</h1>            
                </div>          
            </div>    
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
                    @foreach($userThanks as $userThank)
                        <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-1 thanks-single-box">
                            <p class="thanks-title">{{ $userThank->user->name }}</p>
                            <p class="thaks-content">{{ strip_tags($userThank->content) }}</p>
                            <img class="user-photo" src="{{ asset('images/people.png') }}" alt="Agradecimento" title="Agradecimento" /><br><br>
                            <div class="fb-share-button" data-href="{{ URL::to('/') . '/app/agradecimento-empresa/' . $userThank->hash }}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Compartilhar</a></div>
                            <div class="g-plus" data-action="share" style="display: inline-block;"></div>
                            <a href="whatsapp://send?{{ $userThank->user->name . " - " . strip_tags($userThank->content) }}" data-action="share/whatsapp/share" class="btn btn-success" role="button" style="display: inline-block;"><i class="fa fa-whatsapp fa-fw icon-bold" aria-hidden="true"></i>Compartilhar</a>
                            <a class="twitter-share-button" href="https://twitter.com/intent/tweet?text={{ $userThank->user->name . " - " . strip_tags($userThank->content) }}">Tweet</a>                            
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <footer class="nopadding">        
            <img src="{{ URL::to('/') }}/images/footerUserArea.png" width="100%" />
        </footer>                                    
        <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="{{ URL::asset('js/site.js') }}"></script>                
    </body>
</html>