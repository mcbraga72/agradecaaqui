<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="@yield('keywords')">
        <meta name="author" content="@yield('author')">
        <meta name="description" content="@yield('description')">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta id="csrf-token" name="csrf-token" content="{{{ csrf_token() }}}">
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
        
    </head>
    <body>
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
                    <div class="navbar-collapse collapse" id="menu">                    
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{ url('/') }}" title="">HOME</a></li>
                            <li><a href="{{ url('/apoiadores') }}" title="">APOIADORES</a></li>
                            <li><a href="{{ url('/quem-somos') }}" title="">QUEM SOMOS</a></li>
                            <li><a href="{{ url('/contato') }}" title="">CONTATO</a></li>
                            <li><a href="{{ url('/app') }}" title="">MEUS AGRADECIMENTOS</a></li>
                            <li class="dropdown app-dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <img class="avatar" src="{{ Auth::user()->photo }}" /><span class="caret"></span>
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
                </div>    
            </nav>
        </header>
        <div id="user_area">

            <!-- Create Enterprise Modal -->
            <div class="modal fade" id="enterprise" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-name" id="myModalLabel">Cadastro de empresas</h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createEnterprise">
                                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label for="category_id">Categoria:</label>
                                    <select name="category_id" class="form-control" v-model="newEnterprise.category_id" />
                                        <option value="">Selecione a categoria</option>
                                        <option value="@{{ category.id }}" v-for="category in categories.data">@{{ category.name }}</option>
                                    </select>
                                    <span v-if="formErrors['category_id']" class="error text-danger">@{{ formErrors['category_id'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nome:</label>
                                    <input type="text" name="name" class="form-control" v-model="newEnterprise.name" />
                                    <span v-if="formErrors['name']" class="error text-danger">@{{ formErrors['name'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="contact">Contato:</label>
                                    <input type="text" name="contact" class="form-control" v-model="newEnterprise.contact" />
                                    <span v-if="formErrors['contact']" class="error text-danger">@{{ formErrors['contact'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="name">E-mail:</label>
                                    <input type="email" name="email" class="form-control" v-model="newEnterprise.email" />
                                    <span v-if="formErrors['email']" class="error text-danger">@{{ formErrors['email'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="telephone">Telefone:</label>
                                    <input type="text" name="telephone" class="form-control" v-model="newEnterprise.telephone" />
                                    <span v-if="formErrors['telephone']" class="error text-danger">@{{ formErrors['telephone'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="address">Endereço:</label>
                                    <input type="text" name="address" class="form-control" v-model="newEnterprise.address" />
                                    <span v-if="formErrors['address']" class="error text-danger">@{{ formErrors['address'] }}</span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript" src="/js/vendor/chosen/chosen.jquery.js" type="text/javascript" charset="utf-8"></script>
            <script type="text/javascript">
                $('.chosen-select').chosen();
            </script>                
            @yield('content')
        </div>    
        <footer class="nopadding">
            <div class="col-lg-12 social-networks">
                <a href="https://www.facebook.com/agradecaaqui/" target="_blank"><img src="{{ URL::to('/') }}/images/facebook.png" alt="Perfil no Facebook" title="Perfil no Facebook" /></a>
                <a href="https://www.instagram.com/agradecaaqui/" target="_blank"><img src="{{ URL::to('/') }}/images/instagram.png" alt="Perfil no Instagram" title="Perfil no Instagram" /></a>
            </div>
            <img src="{{ URL::to('/') }}/images/footerUserArea.png" width="100%" />
        </footer>        
    </body>
</html>
