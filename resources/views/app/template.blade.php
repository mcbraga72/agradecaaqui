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
            <nav class="navbar navbar-default navbar-static-top"> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/') }}" title="">HOME</a></li>
                        <li><a href="{{ url('/apoiadores') }}" title="">APOIADORES</a></li>
                        <li><a href="{{ url('/quem-somos') }}" title="">QUEM SOMOS</a></li>
                        <li><a href="{{ url('/contato') }}" title="">CONTATO</a></li>                        
                        <li class="dropdown app-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img src="{{ Auth::user()->photo }}" style="border-radius: 50%;" /><span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li class="caret-dropdown">
                                    <a href="{{ url('/app/agradecimentos') }}" title="">Agradecimentos</a>                                        
                                    <a href="{{ url('app/usuario/' . Auth::user()->id . '/edit') }}">Perfil</a>
                                    <a href="#" data-toggle="modal" data-target="#changePasswordModal">Alterar senha</a>
                                    <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>                
            </nav>
        </header>
        <div id="user_area">

            <!-- Change password Modal -->            
            <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-name" id="myModalLabel">Alteração de senha</h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" role="form" enctype="multipart/form-data" v-on:submit.prevent="changePassword({{ Auth::user()->id }})">
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

            <!-- User's Complete Register Modal -->        
            <script type="text/javascript"> 
                
                $(document).ready(function () {
                
                    $.getJSON('{{ URL::to('/') }}/estados_cidades.json', function (data) {

                        var items = [];
                        var options = '<option value="">Selecione o estado</option>';

                        $.each(data, function (key, val) {
                            options += '<option value="' + val.nome + '" @if(Auth::user()->state === "' + val.nome + '") selected @endif>' + val.nome + '</option>';
                        });
                        $("#state").html(options);
                        
                        $("#state").change(function () {
                        
                            var options_city = '';
                            var str = "";
                            
                            $("#state option:selected").each(function () {
                                str += $(this).text();
                            });
                            
                            $.each(data, function (key, val) {
                                if(val.nome == str) {
                                    $.each(val.cidades, function (key_city, val_city) {
                                        options_city += '<option value="' + val_city + '">' + val_city + '</option>';
                                    });
                                }
                            });

                            $("#city").html(options_city);
                            
                        }).change();
                    
                    });

                    $.getJSON('{{ URL::to('/') }}/paises.json', function (data) {

                        var items = [];
                        var options = '<option value="">Selecione o país</option>';

                        $.each(data, function (key, val) {
                            options += '<option value="' + val.nome + '" @if(Auth::user()->country === "' + val.nome + '") selected @endif>' + val.nome + '</option>';
                        });
                        $("#country").html(options);

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

                function formatHeight(height) {
                    if(height.value.length == 1)
                        height.value = height.value + '.';
                }

                function formatWeight(field, key) {
                    if (event.keyCode < 48 || event.keyCode > 57) {
                        event.returnValue = false;
                        return false;
                    }
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
                            <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updatePhoto({{ Auth::user()->id }})">
                                {{ csrf_field() }}
                                <div class="form-group col-lg-12">
                                    <div class="form-group col-lg-5">
                                        <label for="photo" class="btn"><img src="{{ Auth::user()->photo }}" style="border-radius: 50%;" /></label>
                                        <button type="submit" class="btn btn-primary" style="display: inline !important;">Atualizar Foto</button>
                                        <input type="file" name="photo" id="photo" class="form-control" v-model="photo" style="display: inline !important;">
                                        <span v-if="formErrorsCompleteRegister['photo']" class="error text-danger">@{{ formErrorsCompleteRegister['photo'] }}</span>                                        
                                    </div>
                                </div>                                
                            </form>
                            <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateUser({{ Auth::user()->id }})">
                                {{ csrf_field() }}    
                                <div class="form-group col-lg-4">
                                    <label for="name">Nome:</label>
                                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" v-model="fillUser.name" />
                                    <span v-if="formErrorsCompleteRegister['name']" class="error text-danger">@{{ formErrorsCompleteRegister['name'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="surName">Sobrenome:</label>
                                    <input type="text" name="surName" class="form-control" value="{{ Auth::user()->surName }}" v-model="fillUser.surName" />
                                    <span v-if="formErrorsCompleteRegister['surName']" class="error text-danger">@{{ formErrorsCompleteRegister['surName'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="gender">Sexo:</label>
                                    <select id="gender" name="gender" class="form-control" v-model="fillUser.gender" />
                                        <option value="">Selecione o sexo</option>
                                        <option value="Feminino" @if(Auth::user()->gender === 'Feminino') selected @endif>Feminino</option>
                                        <option value="Masculino" @if(Auth::user()->gender === 'Masculino') selected @endif>Masculino</option>
                                        <option value="Outros" @if(Auth::user()->gender === 'Outros') selected @endif>Outros</option>
                                    </select>                                
                                    <span v-if="formErrorsCompleteRegister['gender']" class="error text-danger">@{{ formErrorsCompleteRegister['gender'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="dateOfBirth">Data de nascimento:</label>
                                    <input type="text" id="dateOfBirth" name="dateOfBirth" class="form-control" value="{{ Auth::user()->dateOfBirth }}" v-model="fillUser.dateOfBirth" maxlength="10" onkeypress="formatDateOfBirth(this)" />
                                    <span v-if="formErrorsCompleteRegister['dateOfBirth']" class="error text-danger">@{{ formErrorsCompleteRegister['dateOfBirth'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="telephone">Celular:</label>
                                    <input type="text" id="telephone" name="telephone" class="form-control" value="{{ Auth::user()->telephone }}" v-model="fillUser.telephone" maxlength="15" onkeypress="formatCellphone(this)" />
                                    <span v-if="formErrorsCompleteRegister['telephone']" class="error text-danger">@{{ formErrorsCompleteRegister['telephone'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="country">País:</label>
                                    <select id="country" name="country" class="form-control" v-model="fillUser.country" />
                                        <option value="">Selecione o país</option>
                                        <option value="Brasil">Brasil</option>
                                    </select>                                
                                    <span v-if="formErrorsCompleteRegister['country']" class="error text-danger">@{{ formErrorsCompleteRegister['country'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="state">Estado:</label>
                                    <select id="state" name="state" class="form-control" v-model="fillUser.state" />
                                        <option value="">Selecione o estado</option>                                    
                                    </select>                                
                                    <span v-if="formErrorsCompleteRegister['state']" class="error text-danger">@{{ formErrorsCompleteRegister['state'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="city">Cidade:</label>
                                    <select id="city" name="city" class="form-control" v-model="fillUser.city" />
                                        <option value="">Selecione a cidade</option>                                    
                                    </select>                                
                                    <span v-if="formErrorsCompleteRegister['city']" class="error text-danger">@{{ formErrorsCompleteRegister['city'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="education">Escolaridade:</label>
                                    <select id="education" name="education" class="form-control" v-model="fillUser.education" />
                                        <option value="">Selecione o nível de escolaridade</option>
                                        <option value="Ensino Fundamental">Ensino Fundamental</option>
                                        <option value="Ensino Médio">Ensino Médio</option>
                                        <option value="Superior">Superior</option>
                                        <option value="Pós-graduado">Pós-graduado</option>
                                        <option value="Mestrado">Mestrado</option>
                                        <option value="Doutorado">Doutorado</option>
                                        <option value="Pós-Doutorado">Pós-Doutorado</option>
                                    </select>                                
                                    <span v-if="formErrorsCompleteRegister['education']" class="error text-danger">@{{ formErrorsCompleteRegister['education'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="email">E-mail:</label>
                                    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" v-model="fillUser.email" />
                                    <span v-if="formErrorsCompleteRegister['email']" class="error text-danger">@{{ formErrorsCompleteRegister['email'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="profession">Profissão:</label>
                                    <input type="text" name="profession" class="form-control" value="{{ Auth::user()->profession }}" v-model="fillUser.profession" />
                                    <span v-if="formErrorsCompleteRegister['profession']" class="error text-danger">@{{ formErrorsCompleteRegister['profession'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="maritalStatus">Estado Civil:</label>
                                    <select id="maritalStatus" name="maritalStatus" class="form-control" v-model="fillUser.maritalStatus" />
                                        <option value="">Selecione o estado civil</option>
                                        <option value="Solteiro(a)">Solteiro(a)</option>
                                        <option value="Casado(a)">Casado(a)</option>
                                        <option value="Separado(a)">Separado(a)</option>
                                        <option value="Divorciado(a)">Divorciado(a)</option>
                                        <option value="Viúvo(a)">Viúvo(a)</option>
                                    </select>                                
                                    <span v-if="formErrorsCompleteRegister['maritalStatus']" class="error text-danger">@{{ formErrorsCompleteRegister['maritalStatus'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="religion">Religião:</label>
                                    <select id="religion" name="religion" class="form-control" v-model="fillUser.religion" />
                                        <option value="">Selecione a religião</option>
                                        <option value="Adventista">Adventista</option>
                                        <option value="Ateìsta">Ateísta</option>
                                        <option value="Budista">Budista</option>
                                        <option value="Católico(a)">Católico(a)</option>
                                        <option value="Candomblé">Candomblé</option>
                                        <option value="Espírita">Espírita</option>
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
                                    <span v-if="formErrorsCompleteRegister['religion']" class="error text-danger">@{{ formErrorsCompleteRegister['religion'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="ethnicity">Etnia:</label>
                                    <select id="ethnicity" name="ethnicity" class="form-control" v-model="fillUser.ethnicity" />
                                        <option value="">Selecione a etnia</option>
                                        <option value="Branco(a)">Branco(a)</option>
                                        <option value="Caboclo(a)">Caboclo(a)</option>
                                        <option value="Cafuzo(a)">Cafuzo(a)</option>
                                        <option value="Indígena">Indígena</option>
                                        <option value="Mulato(a)">Mulato(a)</option>
                                        <option value="Negro(a)">Negro(a)</option>
                                        <option value="Pardo(a)">Pardo(a)</option>                                    
                                    </select>                                
                                    <span v-if="formErrorsCompleteRegister['ethnicity']" class="error text-danger">@{{ formErrorsCompleteRegister['ethnicity'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="income">Renda familiar:</label>
                                    <select id="income" name="income" class="form-control" v-model="fillUser.income" />
                                        <option value="">Selecione a renda familiar</option>
                                        <option value="Até R$ 1.000,00">Até R$ 1.000,00</option>
                                        <option value="De R$ 1.000,01 a R$ 2.000,00">De R$ 1.000,01 a R$ 2.000,00</option>
                                        <option value="De R$ 2.000,01 a R$ 3.000,00">De R$ 2.000,01 a R$ 3.000,00</option>
                                        <option value="De R$ 3.000,01 a R$ 5.000,00">De R$ 3.000,01 a R$ 5.000,00</option>
                                        <option value="De R$ 5.000,01 a R$ 7.500,00">De R$ 5.000,01 a R$ 7.500,00</option>
                                        <option value="De R$ 7.500,01 a R$ 10.000,00">De R$ 7.500,01 a R$ 10.000,00</option>
                                        <option value="Acima de R$ 10.000,00">Acima de R$ 10.000,00</option>
                                    </select>                                
                                    <span v-if="formErrorsCompleteRegister['income']" class="error text-danger">@{{ formErrorsCompleteRegister['income'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="sport">Pratica esporte(s):</label>
                                    <select multiple id="sport" name="sport" class="form-control" v-model="fillUser.sport" />
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
                                    <span v-if="formErrorsCompleteRegister['sport']" class="error text-danger">@{{ formErrorsCompleteRegister['sport'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="soccerTeam">Time de futebol:</label>
                                    <select id="soccerTeam" name="soccerTeam" class="form-control" v-model="fillUser.soccerTeam" />
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
                                    <span v-if="formErrorsCompleteRegister['soccerTeam']" class="error text-danger">@{{ formErrorsCompleteRegister['soccerTeam'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="height">Altura(m):</label>
                                    <input type="text" name="height" class="form-control" value="{{ Auth::user()->height }}" v-model="fillUser.height" maxlength="4" onkeypress="formatHeight(this)" />
                                    <span v-if="formErrorsCompleteRegister['height']" class="error text-danger">@{{ formErrorsCompleteRegister['height'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="weight">Peso(kg):</label>
                                    <input type="text" name="weight" class="form-control" value="{{ Auth::user()->weight }}" v-model="fillUser.weight" maxlength="3" onkeypress="formatWeight(this,event)" />
                                    <span v-if="formErrorsCompleteRegister['weight']" class="error text-danger">@{{ formErrorsCompleteRegister['weight'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="hasCar">Possui automóvel:</label>
                                    <select id="hasCar" name="hasCar" class="form-control" v-model="fillUser.hasCar" />
                                        <option value="">Selecione a melhor opção</option>
                                        <option value="0">Não</option>
                                        <option value="1">Sim</option>                                    
                                    </select>                                
                                    <span v-if="formErrorsCompleteRegister['hasCar']" class="error text-danger">@{{ formErrorsCompleteRegister['hasCar'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="hasChildren">Possui filhos:</label>
                                    <select id="hasChildren" name="hasChildren" class="form-control" v-model="fillUser.hasChildren" />
                                        <option value="">Selecione a melhor opção</option>
                                        <option value="0">Não</option>
                                        <option value="1">Sim</option>                                    
                                    </select>                                
                                    <span v-if="formErrorsCompleteRegister['hasChildren']" class="error text-danger">@{{ formErrorsCompleteRegister['hasChildren'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="liveWith">Mora com quem:</label>
                                    <select id="liveWith" name="liveWith" class="form-control" v-model="fillUser.liveWith" />
                                        <option value="">Selecione a melhor opção</option>
                                        <option value="Com a família">Com a família</option>
                                        <option value="Com amigos ou colegas">Com amigos ou colegas</option>
                                        <option value="Sozinho">Sozinho</option>                                    
                                    </select>                                
                                    <span v-if="formErrorsCompleteRegister['liveWith']" class="error text-danger">@{{ formErrorsCompleteRegister['liveWith'] }}</span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="pet">Possui animal(ais) de estimação:</label>
                                    <select multiple id="pet" name="pet" class="form-control" v-model="fillUser.pet" />
                                        <option value="">Selecione o(s) animal(ais) de estimação</option>
                                        <option value="Aves">Aves</option>
                                        <option value="Cachorro">Cachorro</option>
                                        <option value="Gato">Gato</option>
                                        <option value="Peixe">Peixe</option>
                                        <option value="Outros">Outros</option>
                                    </select>                                
                                    <span v-if="formErrorsCompleteRegister['pet']" class="error text-danger">@{{ formErrorsCompleteRegister['pet'] }}</span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>    
        @yield('content')
        <footer class="nopadding">        
            <img src="{{ URL::to('/') }}/images/footerUserArea.png" width="100%" />
        </footer>        
    </body>
</html>
