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
        <link rel="stylesheet" property="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" property="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ URL::asset('css/site.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/reset.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-social.css') }}">
        <link rel="stylesheet" href="css/vendor/bootstrap-chosen/bootstrap-chosen.css">
    </head>
    <body>
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
        @yield('content')
        <footer class="nopadding">        
            <img src="{{ URL::to('/') }}/images/footer.png" width="100%" />
        </footer>

        <!-- User's Complete Register Modal -->
        <div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-name" id="myModalLabel">Cadastro completo</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createUser">
                            <div class="form-group">
                                <label for="name">Nome:</label>
                                <input type="text" name="name" class="form-control" v-model="newUser.name" />
                                <span v-if="formErrors['name']" class="error text-danger">@{{ formErrors['name'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="surName">Sobrenome:</label>
                                <input type="text" name="surName" class="form-control" v-model="newUser.surName" />
                                <span v-if="formErrors['surName']" class="error text-danger">@{{ formErrors['surName'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="gender">Sexo:</label>
                                <br>
                                <label class="radio-inline">
                                    <input type="radio" class="form-control radio-register" id="gender" name="gender" value="masculino" v-model="gender">MASCULINO
                                </label>
                                <label class="radio-inline">    
                                    <input type="radio" class="form-control radio-register" id="gender" name="gender" value="feminino" v-model="gender">FEMININO
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" class="form-control radio-register" id="gender" name="gender" value="outros" v-model="gender">OUTROS
                                </label>                                
                                <span v-if="formErrors['gender']" class="error text-danger">@{{ formErrors['gender'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="dateOfBirth">Data de nascimento:</label>
                                <input type="text" id="dateOfBirth" name="dateOfBirth" class="form-control" v-model="newUser.dateOfBirth" maxlength="10" onkeypress="formatDateOfBirth(this)" />
                                <span v-if="formErrors['dateOfBirth']" class="error text-danger">@{{ formErrors['dateOfBirth'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="telephone">Celular:</label>
                                <input type="text" id="telephone" name="telephone" class="form-control" v-model="newUser.telephone" maxlength="15" onkeypress="formatCellphone(this)" />
                                <span v-if="formErrors['telephone']" class="error text-danger">@{{ formErrors['telephone'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="state">Estado:</label>
                                <select id="stateCreate" name="state" class="form-control" v-model="newUser.state" />
                                    <option value="">Selecione o estado</option>                                    
                                </select>                                
                                <span v-if="formErrors['state']" class="error text-danger">@{{ formErrors['state'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="city">Cidade:</label>
                                <select id="cityCreate" name="city" class="form-control" v-model="newUser.city" />
                                    <option value="">Selecione a cidade</option>                                    
                                </select>                                
                                <span v-if="formErrors['city']" class="error text-danger">@{{ formErrors['city'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="name">E-mail:</label>
                                <input type="email" name="email" class="form-control" v-model="newUser.email" />
                                <span v-if="formErrors['email']" class="error text-danger">@{{ formErrors['email'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="password">Senha:</label>
                                <input type="password" name="password" class="form-control" v-model="newUser.password" />
                                <span v-if="formErrors['password']" class="error text-danger">@{{ formErrors['password'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">Confirmar Senha:</label>
                                <input type="password" name="password-confirm" class="form-control" v-model="newUser.password" />
                                <span v-if="formErrors['password-confirm']" class="error text-danger">@{{ formErrors['password-confirm'] }}</span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="{{ URL::asset('js/site.js') }}"></script>        
    </body>
</html>
