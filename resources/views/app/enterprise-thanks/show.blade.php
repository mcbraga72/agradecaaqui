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
        <meta id="token" name="token" value="{{ csrf_token() }}">

        <!-- Open Graph data -->
        <meta property="og:title" content="Agradeça Aqui" />
        <meta property="og:type" content="website" />
        @foreach($data['enterpriseThanks'] as $enterpriseThank)        
        <meta property="og:url" content="{{ 'https://agradecaaqui.site/app/agradecimento-empresa/' . $enterpriseThank->hash }}" />
        @endforeach        
        <meta property="og:image" content="https://agradecaaqui.site/images/banner.png" />
        <meta property="og:description" content="Faça seu agradecimento em nossa plataforma!" />
        <meta property="og:site_name" content="Agradeça Aqui" />
        <meta property="fb:app_id" content="752484724908381" />

        <!-- Twitter Card data -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@agradecaaqui">
        <meta name="twitter:creator" content="@agradecaaqui">
        <meta name="twitter:title" content="Agradeça Aqui">
        <meta name="twitter:description" content="Faça seu agradecimento em nossa plataforma!">
        <meta name="twitter:image" content="https://agradecaaqui.site/images/banner.png">
        
        <link rel="shortcut icon" href="https://agradecaaqui.site/images/logo.png" />
        <link rel="stylesheet" property="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" property="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <link rel="stylesheet" href="{{ URL::asset('css/site.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/reset.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-social.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/vendor/bootstrap-chosen/bootstrap-chosen.css') }}">
        
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/') }}" title="">HOME</a></li>
                        <li><a href="{{ url('/parceiros') }}" title="">PARCEIROS</a></li>
                        <li><a href="{{ url('/quem-somos') }}" title="">QUEM SOMOS</a></li>
                        <li><a href="{{ url('/mais-agradecidas') }}" title="">+AGRADECIDAS</a></li>
                        <li><a href="{{ url('/blog/') }}" title="">BLOG</a></li>
                        <li><a href="{{ url('/contato') }}" title="">CONTATO</a></li>
                        <li><a href="{{ url('/app') }}" title="">MEUS AGRADECIMENTOS</a></li>
                        <li class="dropdown app-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img src="{{ Auth::user()->photo }}" style="border-radius: 50%;" /><span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li class="caret-dropdown">
                                    <a href="{{ url('app/usuario/' . Auth::user()->id . '/edit') }}" class="item-menu-dropdown">PERFIL</a>                                    
                                    <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="item-menu-dropdown">SAIR</a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>                
            </nav>
        </header>
        <div class="container-fluid show-thanks">
            <div class="row">
                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                    <img class="logo-login" src="{{asset('images/logo.png')}}"" />
                    <h1 class="support">Compartilhar agradecimento</h1>            
                </div>          
            </div>    
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    @foreach($data['enterpriseThanks'] as $enterpriseThank)
                        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 thanks-single-box">
                            <img class="user-photo" src="{{ asset($enterpriseThank->enterprise->logo) }}" alt="Agradecimento" title="Agradecimento" />
                            <p class="thanks-title">{{ $enterpriseThank->enterprise->name }}</p><br><br>
                            <p class="thanks-stage">Agradecimento</p>
                            <p class="thanks-content-show">{{ strip_tags($enterpriseThank->content) }}</p>
                            <p class="thanks-stage">Réplica</p>			                
                            @if($enterpriseThank->replica != null && $enterpriseThank->replica != '')
                            <p class="thanks-content-show">{{ strip_tags($enterpriseThank->replica) }}</p>
			                @else
                            <p class="thanks-content-show">Aguardando a empresa reponder o agradecimento.</p>
			                @endif
                            <p class="thanks-stage">Tréplica</p>
                            @if($enterpriseThank->rejoinder != null && $enterpriseThank->rejoinder != '')                            
                            <p class="thanks-content-show">{{ strip_tags($enterpriseThank->rejoinder) }}</p>
                            @elseif($enterpriseThank->replica != null && $enterpriseThank->replica != '' && $enterpriseThank->rejoinder == null)
                            <p class="thanks-content-show"></p>
                            @else
                            <p class="thanks-content-show">Aguarde a empresa responder para fazer sua tréplica.</p>
                            @endif
                            @if($enterpriseThank->replica != null && $enterpriseThank->replica != '' && $enterpriseThank->rejoinder == null)
                                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#writeRejoinder">Enviar Tréplica</button>
                            @else
                                <button type="submit" class="btn btn-primary" disabled>Enviar Tréplica</button>
                            @endif
                            <div class="social-media-share">
                                <a href="whatsapp://send?{{ $enterpriseThank->enterprise->name . " - " . strip_tags($enterpriseThank->content) }}" data-action="share/whatsapp/share" class="btn btn-success" role="button" style="display: inline-block;"><i class="fa fa-whatsapp fa-fw icon-bold" aria-hidden="true"></i>Compartilhar</a>
                                <a class="twitter-share-button" href="https://twitter.com/intent/tweet?text={{ $enterpriseThank->enterprise->name . " - " . strip_tags($enterpriseThank->content) }}">Tweet</a>
                                <div class="fb-share-button" data-href="{{ URL::to('/') . '/app/agradecimento-empresa/' . $enterpriseThank->hash }}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Compartilhar</a></div>
                                <div class="g-plus" data-action="share" style="display: inline-block;"></div>                            
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Write Rejoinder Modal -->
        <div class="modal fade" id="writeRejoinder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-name" id="myModalLabel">Responder Agradecimento</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{!! '/app/agradecimento-empresa/treplica/' . collect(request()->segments())->last() !!}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="name">Mensagem</label>
                                <textarea id="rejoinder" name="rejoinder" class="form-control"></textarea>                                
                            </div>                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <footer class="nopadding">        
            <img src="{{ URL::to('/') }}/images/footerUserArea.png" width="100%" />
        </footer>

        <script type="text/javascript">            
            $(document).ready(function() {
                var showMessage = '{{ $data['showMessage'] }}';
                
                if(showMessage == 'true') {
                    toastr.success('Agradecimento atualizado com sucesso!', '', {timeOut: 5000});                
                } else if(showMessage == 'new') {
                    toastr.success('Agradecimento cadastrado com sucesso!', '', {timeOut: 5000});                
                } 
            });
        </script>
    </body>
</html>
