<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta id="token" name="token" value="{{ csrf_token() }}">
        <title>Agradeça Aqui | Admin</title>  

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/css/vendor/admin-lte.min.css">
        <link rel="stylesheet" href="{{ URL::to('/') }}/css/admin.css">

        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="//codeorigin.jquery.com/ui/1.10.2/jquery-ui.min.js"></script>
        <script src="{{ URL::asset('js/app.js') }}"></script>
        <script src="{{ URL::asset('js/vendor/adminlte/app.min.js') }}"></script>
        <script src="{{ URL::asset('js/admin-administrators.js') }}"></script>
        <script>
              window.Laravel = {!! json_encode([
                  'csrfToken' => csrf_token(),
              ]) !!};
        </script>      
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <a href="#" class="logo"><span class="logo-lg"><b>Admin</b> - Agradeça Aqui</span></a>
                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"><span class="sr-only">Toggle navigation</span></a>
                    <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>                  
                </nav>
            </header>
            <aside class="main-sidebar">
                <section class="sidebar">
                    <ul class="sidebar-menu">
                        <li><a href="{{ url('admin/painel') }}"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                        <li><a href="{{ url('admin/administradores/listar') }}"><i class="fa fa-user-plus"></i> <span>Administradores</span></a></li>
                        <li><a href="{{ url('admin/usuarios/listar') }}"><i class="fa fa-user"></i> <span>Usuários</span></a></li>
                        <li><a href="{{ url('admin/empresas/listar') }}"><i class="fa fa-industry"></i> <span>Empresas</span></a></li>
                        <li><a href="{{ url('admin/categorias/listar') }}"><i class="fa fa-sort-alpha-asc"></i> <span>Categorias</span></a></li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-heart"></i> <span>Agradecimentos</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                            <ul class="treeview-menu">
                                <li><a href="{{ url('admin/agradecimentos-empresas/listar') }}"><i class="fa fa-industry"></i> Empresas</a></li>
                                <li><a href="{{ url('admin/agradecimentos-usuarios/listar') }}"><i class="fa fa-user"></i> Usuários</a></li>
                            </ul>
                        </li>        
                        <li><a href="{{ url('admin/relatorios') }}"><i class="fa fa-bar-chart"></i> <span>Relatórios</span></a></li>
                        <li><a href="{{ url('admin/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i><span>Sair</span></a></li>
                    </ul>
                </section>            
            </aside>        
            <div class="content-wrapper">
                <section class="content-header">
                    <h1>Painel Administrativo</h1>
                </section>
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/vue.resource/0.9.3/vue-resource.min.js"></script>
    </body>
</html>
