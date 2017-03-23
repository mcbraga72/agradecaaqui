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
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
        <!-- User's Complete Register Modal -->        
        <script type="text/javascript"> 
            
            $(document).ready(function () {
            
                $.getJSON('{{ URL::to('/') }}/estados_cidades.json', function (data) {

                    var items = [];
                    var options = '<option value="">Selecione o estado</option>';    

                    $.each(data, function (key, val) {
                        options += '<option value="' + val.nome + '">' + val.nome + '</option>';
                    });                 
                    $("#stateCreate").html(options);
                    $("#stateUpdate").html(options);
                    
                    $("#stateCreate").change(function () {              
                    
                        var options_cityCreate = '';
                        var str = "";                   
                        
                        $("#stateCreate option:selected").each(function () {
                            str += $(this).text();
                        });
                        
                        $.each(data, function (key, val) {
                            if(val.nome == str) {                           
                                $.each(val.cidades, function (key_cityCreate, val_cityCreate) {
                                    options_cityCreate += '<option value="' + val_cityCreate + '">' + val_cityCreate + '</option>';
                                });                         
                            }
                        });

                        $("#cityCreate").html(options_cityCreate);
                        
                    }).change();

                    $("#stateUpdate").change(function () {              
                    
                        var options_cityUpdate = '';
                        var str = "";                   
                        
                        $("#stateUpdate option:selected").each(function () {
                            str += $(this).text();
                        });
                        
                        $.each(data, function (key, val) {
                            if(val.nome == str) {                           
                                $.each(val.cidades, function (key_cityUpdate, val_cityUpdate) {
                                    options_cityUpdate += '<option value="' + val_cityUpdate + '">' + val_cityUpdate + '</option>';
                                });                         
                            }
                        });

                        $("#cityUpdate").html(options_cityUpdate);
                        
                    }).change();        
                
                });
            
            });

            function formatCellphone(cellphone){ 
                if(cellphone.value.length == 0)
                    cellphone.value = '(' + cellphone.value;
                if(cellphone.value.length == 3)
                    cellphone.value = cellphone.value + ') ';
                if(cellphone.value.length == 10)
                    cellphone.value = cellphone.value + '-';  
            }

            function formatDateOfBirth(dateOfBirth) {
                if(dateOfBirth.value.length == 2)
                    dateOfBirth.value = dateOfBirth.value + '/';
                if(dateOfBirth.value.length == 5)
                    dateOfBirth.value = dateOfBirth.value + '/';        
            }
            
        </script>
        <div class="modal fade col-lg-8 col-lg-offset-2" id="completeRegister" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-admin col-lg-12 col-lg-offset-0" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-name" id="myModalLabel">Cadastro completo</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ url('/app/perfil/' . Auth::user()->id) }}">
                            <div class="form-group col-lg-4 {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">Nome:</label>
                                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" />
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('surName') ? ' has-error' : '' }}">
                                <label for="surName">Sobrenome:</label>
                                <input type="text" name="surName" class="form-control" value="{{ Auth::user()->surName }}" />
                                @if ($errors->has('surName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('surName') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label for="gender">Sexo:</label>
                                <select id="gender" name="gender" class="form-control" value="{{ Auth::user()->gender }}" />
                                    <option value="">Selecione o sexo</option>
                                    <option value="Feminino">Feminino</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Outros">Outros</option>                                    
                                </select>                                
                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>                            
                            <div class="form-group col-lg-4 {{ $errors->has('dateOfBirth') ? ' has-error' : '' }}">
                                <label for="dateOfBirth">Data de nascimento:</label>
                                <input type="text" id="dateOfBirth" name="dateOfBirth" class="form-control" value="{{ Auth::user()->dateOfBirth }}" maxlength="10" onkeypress="formatDateOfBirth(this)" />
                                @if ($errors->has('dateOfBirth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dateOfBirth') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('telephone') ? ' has-error' : '' }}">
                                <label for="telephone">Celular:</label>
                                <input type="text" id="telephone" name="telephone" class="form-control" value="{{ Auth::user()->telephone }}" maxlength="15" onkeypress="formatCellphone(this)" />
                                @if ($errors->has('telephone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telephone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('country') ? ' has-error' : '' }}">
                                <label for="country">País:</label>
                                <select id="countryCreate" name="country" class="form-control" />
                                    <option value="">Selecione o país</option>                                    
                                </select>                                
                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('state') ? ' has-error' : '' }}">
                                <label for="state">Estado:</label>
                                <select id="stateCreate" name="state" class="form-control" />
                                    <option value="">Selecione o estado</option>                                    
                                </select>                                
                                @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="city">Cidade:</label>
                                <select id="cityCreate" name="city" class="form-control" />
                                    <option value="">Selecione a cidade</option>                                    
                                </select>                                
                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('education') ? ' has-error' : '' }}">
                                <label for="education">Escolaridade:</label>
                                <select id="education" name="education" class="form-control" />
                                    <option value="">Selecione o nível de escolaridade</option>
                                    <option value="fundamental">Ensino Fundamental</option>
                                    <option value="medio">Ensino Médio</option>
                                    <option value="superior">Superior</option>
                                    <option value="pos-graduado">Pós-graduado</option>
                                    <option value="mestrado">Mestrado</option>
                                    <option value="doutorado">Doutorado</option>
                                    <option value="pos-doutorado">Pós-Doutorado</option>
                                </select>                                
                                @if ($errors->has('education'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('education') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">E-mail:</label>
                                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" />
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('profession') ? ' has-error' : '' }}">
                                <label for="profession">Profissão:</label>
                                <input type="text" name="profession" class="form-control" value="{{ Auth::user()->profession }}" />
                                @if ($errors->has('profession'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('profession') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('maritalStatus') ? ' has-error' : '' }}">
                                <label for="maritalStatus">Estado Civil:</label>
                                <select id="maritalStatus" name="maritalStatus" class="form-control" />
                                    <option value="">Selecione o estado civil</option>
                                    <option value="solteiro">Solteiro(a)</option>
                                    <option value="casado">Casado(a)</option>
                                    <option value="separado">Separado(a)</option>
                                    <option value="divorciado">Divorciado(a)</option>
                                    <option value="viuvo">Viúvo(a)</option>
                                </select>                                
                                @if ($errors->has('maritalStatus'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('maritalStatus') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('religion') ? ' has-error' : '' }}">
                                <label for="religion">Religião:</label>
                                <select id="religion" name="religion" class="form-control" />
                                    <option value="">Selecione a religião</option>
                                    <option value="Adventista">Adventista</option>
                                    <option value="Ateìsta">Ateísta</option>
                                    <option value="Budista">Budista</option>
                                    <option value="Católico(a)">Católico(a)</option>
                                    <option value="Candomblé">Candomblé</option>
                                    <option value="Espírita">Espírita</option>
                                    <option value="Evangélico">Evangélico</option>
                                    <option value="Islamismo">Hinduismo</option>
                                    <option value="Islamismo">Islamismo</option>
                                    <option value="Judaísmo">Judaísmo</option>
                                    <option value="Messiânico">Messiânico</option>
                                    <option value="Metodista">Metodista</option>
                                    <option value="Mórmom">Mórmom</option>
                                    <option value="Ortodoxo(a)">Ortodoxo(a)</option>
                                    <option value="Presbiteriano(a)">Presbiteriano(a)</option>
                                    <option value="Protestante">Protestante</option>
                                    <option value="Testemunha de Jeová">Testemunha de Jeová</option>
                                    <option value="Umbanda">Umbanda</option>                                    
                                </select>                                
                                @if ($errors->has('religion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('religion') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('ethnicity') ? ' has-error' : '' }}">
                                <label for="ethnicity">Etnia:</label>
                                <select id="ethnicity" name="ethnicity" class="form-control" />
                                    <option value="">Selecione a etnia</option>
                                    <option value="Branco(a)">Branco(a)</option>
                                    <option value="Caboclo(a)">Caboclo(a)</option>
                                    <option value="Cafuzo(a)">Cafuzo(a)</option>
                                    <option value="Indígena">Indígena</option>
                                    <option value="Mulato(a)">Mulato(a)</option>
                                    <option value="Negro(a)">Negro(a)</option>
                                    <option value="Pardo(a)">Pardo(a)</option>                                    
                                </select>                                
                                @if ($errors->has('ethnicity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ethnicity') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('income') ? ' has-error' : '' }}">
                                <label for="income">Renda familiar:</label>
                                <select id="income" name="income" class="form-control" />
                                    <option value="">Selecione a renda familiar</option>
                                    <option value="Até R$ 1.000,00">Até R$ 1.000,00</option>
                                    <option value="De R$ 1.000,01 a R$ 2.000,00">De R$ 1.000,01 a R$ 2.000,00</option>
                                    <option value="De R$ 2.000,01 a R$ 3.000,00">De R$ 2.000,01 a R$ 3.000,00</option>
                                    <option value="De R$ 3.000,01 a R$ 5.000,00">De R$ 3.000,01 a R$ 5.000,00</option>
                                    <option value="De R$ 5.000,01 a R$ 7.500,00">De R$ 5.000,01 a R$ 7.500,00</option>
                                    <option value="De R$ 7.500,01 a R$ 10.000,00">De R$ 7.500,01 a R$ 10.000,00</option>
                                    <option value="Acima de R$ 10.000,00">Acima de R$ 10.000,00</option>
                                </select>                                
                                @if ($errors->has('income'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('income') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('sport') ? ' has-error' : '' }}">
                                <label for="sport">Pratica esporte(s):</label>
                                <select multiple id="sport" name="sport" class="form-control" />
                                    <option value="">Selecione o(s) esporte(s)</option>
                                    <option value="Atletismo">Atletismo</option>
                                    <option value="Basquete">Basquete</option>
                                    <option value="Ciclismo">Ciclismo</option>
                                    <option value="Equitação">Equitação</option>
                                    <option value="Futebol">Futebol</option>
                                    <option value="Ginástica">Ginástica</option>
                                    <option value="Golfe">Golfe</option>
                                    <option value="Lutas">Lutas</option>
                                    <option value="Musculação">Musculação</option>
                                    <option value="Natação">Natação</option>
                                    <option value="Skate">Skate</option>
                                    <option value="Surf">Surf</option>
                                    <option value="Tênis">Tênis</option>
                                    <option value="Vôlei">Vôlei</option>
                                    <option value="Outros">Outros</option>
                                </select>                                
                                @if ($errors->has('sport'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sport') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('soccerTeam') ? ' has-error' : '' }}">
                                <label for="soccerTeam">Time de futebol:</label>
                                <select id="soccerTeam" name="soccerTeam" class="form-control" />
                                    <option value="">Selecione o seu time de futebol</option>
                                    <option value="ABC">ABC</option>
                                    <option value="América-MG">América-MG</option>
                                    <option value="América-RN">América-RN</option>
                                    <option value="Atlético-GO">Atlético-GO</option>
                                    <option value="Atlético-MG">Atlético-MG</option>
                                    <option value="Atlético-PR">Atlético-PR</option>
                                    <option value="Avaí">Avaí</option>
                                    <option value="Bahia">Bahia</option>
                                    <option value="Botafogo">Botafogo</option>
                                    <option value="Ceará">Ceará</option>
                                    <option value="Chapecoense">Chapecoense</option>
                                    <option value="Corinthians">Corinthians</option>
                                    <option value="Coritiba">Coritiba</option>
                                    <option value="CRB">CRB</option>
                                    <option value="Cricíúma">Cricíúma</option>
                                    <option value="Cruzeiro">Cruzeiro</option>
                                    <option value="Figueirense">Figueirense</option>
                                    <option value="Flamengo">Flamengo</option>
                                    <option value="Fluminense">Fluminense</option>
                                    <option value="Fortaleza">Fortaleza</option>
                                    <option value="Goiás">Goiás</option>
                                    <option value="Grêmio">Grêmio</option>
                                    <option value="Guarani">Guarani</option>
                                    <option value="Internacional">Internacional</option>
                                    <option value="Juventude">Juventude</option>
                                    <option value="Náutico">Náutico</option>
                                    <option value="Palmeiras">Palmeiras</option>
                                    <option value="Paraná">Paraná</option>
                                    <option value="Ponte Preta">Ponte Preta</option>
                                    <option value="Portuguesa">Portuguesa</option>
                                    <option value="Paysandu">Paysandu</option>
                                    <option value="Santa Cruz">Santa Cruz</option>
                                    <option value="Santos">Santos</option>
                                    <option value="São Paulo">São Paulo</option>
                                    <option value="Sport">Sport</option>
                                    <option value="Vasco">Vasco</option>
                                    <option value="Vitória">Vitória</option>
                                    <option value="Outro">Outro</option>
                                </select>                                
                                @if ($errors->has('soccerTeam'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('soccerTeam') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('height') ? ' has-error' : '' }}">
                                <label for="height">Altura:</label>
                                <input type="text" name="height" class="form-control" value="{{ Auth::user()->height }}" />
                                @if ($errors->has('height'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('height') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('weight') ? ' has-error' : '' }}">
                                <label for="weight">Peso:</label>
                                <input type="text" name="weight" class="form-control" value="{{ Auth::user()->weight }}" />
                                @if ($errors->has('weight'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('hasCar') ? ' has-error' : '' }}">
                                <label for="hasCar">Possui automóvel:</label>
                                <select id="hasCar" name="hasCar" class="form-control" />
                                    <option value="">Selecione a melhor opção</option>
                                    <option value="Não">Não</option>
                                    <option value="Sim">Sim</option>                                    
                                </select>                                
                                @if ($errors->has('hasCar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hasCar') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('hasChildren') ? ' has-error' : '' }}">
                                <label for="hasChildren">Possui filhos:</label>
                                <select id="hasChildren" name="hasChildren" class="form-control" />
                                    <option value="">Selecione a melhor opção</option>
                                    <option value="Não">Não</option>
                                    <option value="Sim">Sim</option>                                    
                                </select>                                
                                @if ($errors->has('hasChildren'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hasChildren') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('liveWith') ? ' has-error' : '' }}">
                                <label for="liveWith">Mora com quem:</label>
                                <select id="liveWith" name="liveWith" class="form-control" />
                                    <option value="">Selecione a melhor opção</option>
                                    <option value="Com a família">Com a femília</option>
                                    <option value="Com amigos ou colegas">Com amigos ou colegas</option>
                                    <option value="Sozinho">Sozinho</option>                                    
                                </select>                                
                                @if ($errors->has('liveWith'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('liveWith') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-lg-4 {{ $errors->has('pet') ? ' has-error' : '' }}">
                                <label for="pet">Possui animal(ais) de estimação:</label>
                                <select multiple id="pet" name="pet" class="form-control" />
                                    <option value="">Selecione o(s) animal(ais) de estimação</option>
                                    <option value="Aves">Aves</option>
                                    <option value="Cachorro">Cachorro</option>
                                    <option value="Gato">Gato</option>
                                    <option value="Peixe">Peixe</option>
                                    <option value="Outros">Outros</option>
                                </select>                                
                                @if ($errors->has('pet'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pet') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
        @yield('content')
        <footer class="nopadding">        
            <img src="{{ URL::to('/') }}/images/footer.png" width="100%" />
        </footer>
        <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="{{ URL::asset('js/site.js') }}"></script>        
    </body>
</html>
