<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="_token" content="{{ csrf_token() }}">
        <title>Agradeça Aqui | Admin</title>  

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/css/vendor/admin-lte.min.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/css/enterprise.css">

        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>        
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>        
                
    </head>
    <body class="hold-transition skin-blue sidebar-mini" id="enterprise_area">        
        <!-- Change password Modal -->            
        <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-name" id="myModalLabel">Alteração de senha</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" role="form" enctype="multipart/form-data" v-on:submit.prevent="changePassword({{ Auth::guard('enterprises')->user()->id }})">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="currentPassword">Senha atual:</label>
                                <input type="password" name="currentPassword" class="form-control" v-model="updatePassword.currentPassword" />
                                <span v-if="formErrorsUpdate['currentPassword']" class="error text-danger">@{{ formErrorsUpdate['currentPassword'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="password">Nova Senha:</label>
                                <input type="password" name="password" class="form-control" v-model="updatePassword.password" />
                                <span v-if="formErrorsUpdate['password']" class="error text-danger">@{{ formErrorsUpdate['password'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="passwordConfirm">Confirmar Nova Senha:</label>
                                <input type="password" name="passwordConfirm" class="form-control" v-model="updatePassword.passwordConfirm" />
                                <span v-if="formErrorsUpdate['passwordConfirm']" class="error text-danger">@{{ formErrorsUpdate['passwordConfirm'] }}</span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>        
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
                                    <a href="{{ url('/empresa/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
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
                        <li><a href="{{ url('/empresa/perfil/' . Auth::guard('enterprises')->user()->id . '/editar') }}"><i class="fa fa-user"></i><span>Perfil</span></a></li>
                        <li><a href="#" data-toggle="modal" data-target="#changePasswordModal"><i class="fa fa-key"></i><span>Alterar senha</span></a><li>
                        <li><a href="{{ url('/empresa/agradecimentos/listar') }}"><i class="fa fa-heart"></i><span>Agradecimentos</span></a></li>
                        <li><a href="{{ url('/empresa/relatorios') }}"><i class="fa fa-bar-chart"></i><span>Relatórios</span></a></li>
                        <li><a href="{{ url('/empresa/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i><span>Sair</span></a></li>
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
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/vue.resource/0.9.3/vue-resource.min.js"></script>
        <script type="text/javascript" src="{{ URL::to('/') }}/js/vendor/adminlte/app.min.js"></script>
        <script type="text/javascript" src="{{ URL::to('/') }}/js/app-enterprises.js"></script>
    </body>
</html>
