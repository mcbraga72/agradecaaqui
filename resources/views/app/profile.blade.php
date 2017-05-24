@extends('app.template')

@section('content')
	<div class="container-fluid">
		<div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2 home">
            	<script type="text/javascript"> 
    
    				$(document).ready(function () {

	            		$.getJSON('{{ URL::to('/') }}/paises.json', function (data) {

	                        var items = [];
	                        var options = '<option value="">Selecione o país</option>';

	                        $.each(data, function (key, val) {
	                        	if (val.nome == "{{ Auth::user()->country }}") {
	                            	options += '<option value="' + val.nome + '" selected="selected">' + val.nome + '</option>';
	                            } else {
	                            	options += '<option value="' + val.nome + '">' + val.nome + '</option>';
	                            }
	                        });

	                        $("#country").html(options);
	                        
	                    });

	                    $.getJSON('{{ URL::to('/') }}/estados_cidades.json', function (data) {

	                        var items = [];
	                        var options = '<option value="">Selecione o estado</option>';

	                        $.each(data, function (key, val) {
	                        	if (val.nome == "{{ Auth::user()->state }}") {
	                            	options += '<option value="' + val.nome + '" selected="selected">' + val.nome + '</option>';
	                            } else {
	                            	options += '<option value="' + val.nome + '">' + val.nome + '</option>';
	                            }
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
	                                    	if (val_city == "{{ Auth::user()->city }}") {
				                            	options_city += '<option value="' + val_city + '" selected="selected">' + val_city + '</option>';
				                            } else {
				                            	options_city += '<option value="' + val_city + '">' + val_city + '</option>';
				                            }	                                        	
	                                    });
	                                }
	                            });

	                            $("#city").html(options_city);
	                            
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

				<h1 class="profile-title">Perfil</h1>
				<div class="form-group col-lg-12">
					<div class="form-group col-lg-5 form-box" style="margin-left: 4%;">
	                    <form class="profile-form" method="POST" role="form" enctype="multipart/form-data" v-on:submit.prevent="changePassword({{ Auth::user()->id }})">
	                        {{ csrf_field() }}
	                        <div class="form-group col-lg-12 profile-item">
	                            <label for="currentPassword">Senha atual:</label>
	                            <input type="password" name="currentPassword" class="form-control" v-model="updatePassword.currentPassword" />
	                            <span v-if="formErrorsUpdate['currentPassword']" class="error text-danger">@{{ formErrorsUpdate['currentPassword'] }}</span>
	                        </div>
	                        <div class="form-group col-lg-12 profile-item">
	                            <label for="password">Nova Senha:</label>
	                            <input type="password" name="password" class="form-control" v-model="updatePassword.password" />
	                            <span v-if="formErrorsUpdate['password']" class="error text-danger">@{{ formErrorsUpdate['password'] }}</span>
	                        </div>
	                        <div class="form-group col-lg-12 profile-item">
	                            <label for="passwordConfirm">Confirmar Nova Senha:</label>
	                            <input type="password" name="passwordConfirm" class="form-control" v-model="updatePassword.passwordConfirm" />
	                            <span v-if="formErrorsUpdate['passwordConfirm']" class="error text-danger">@{{ formErrorsUpdate['passwordConfirm'] }}</span>
	                        </div>
	                        <div class="form-group col-lg-12 profile-item">
	                            <button type="submit" class="btn btn-primary">Alterar Senha</button>
	                        </div>
	                    </form>
	                </div>
	                <div class="form-group col-lg-5 col-lg-offset-1 form-box">
		            	<form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updatePhoto({{ Auth::user()->id }})">
		                {{ csrf_field() }}
		                    <div class="form-group col-lg-12 profile-item">
		                        <label for="photo" class="btn"><img src="{{ Auth::user()->photo }}" style="border-radius: 50%;" /></label>
		                        <button type="submit" class="btn btn-primary" style="display: inline !important;">Atualizar Foto</button>
		                        <input type="file" name="photo" id="photo" class="form-control" v-model="photo" style="display: inline !important;">
		                    </div>	                
		            	</form>
					</div>
                </div>
	            <div class="form-group col-lg-12 form-box">
		            <form class="profile-form" method="POST" v-on:submit.prevent="updateUser({{ Auth::user()->id }})">
		                {{ csrf_field() }}    
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="name">Nome</label>
		                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" v-model="fillUser.name" />
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="surName">Sobrenome</label>
		                    <input type="text" name="surName" class="form-control" value="{{ Auth::user()->surName }}" v-model="fillUser.surName" />
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="gender">Sexo</label>
		                    <select id="gender" name="gender" class="form-control" v-model="fillUser.gender" />
		                        <option value="">Selecione o sexo</option>
		                        <option value="Feminino" @if(Auth::user()->gender === 'Feminino') selected="selected" @endif>Feminino</option>
		                        <option value="Masculino" @if(Auth::user()->gender === 'Masculino') selected="selected" @endif>Masculino</option>
		                        <option value="Outros" @if(Auth::user()->gender === 'Outros') selected="selected" @endif>Outros</option>
		                    </select>		                    
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="dateOfBirth">Data de nascimento</label>
		                    <input type="text" id="dateOfBirth" name="dateOfBirth" class="form-control" value="{{ Auth::user()->dateOfBirth }}" maxlength="10" onkeypress="formatDateOfBirth(this)" v-model="fillUser.dateOfBirth" />		                    
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="telephone">Celular</label>
		                    <input type="text" id="telephone" name="telephone" class="form-control" value="{{ Auth::user()->telephone }}" maxlength="15" onkeypress="formatCellphone(this)" v-model="fillUser.telephone" />		                    
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="country">País</label>
		                    <select id="country" name="country" class="form-control" value="{{ Auth::user()->country }}" v-model="fillUser.country" />
		                        <option value="">Selecione o país</option>		                        
		                    </select>		                    
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="state">Estado</label>
		                    <select id="state" name="state" class="form-control" value="{{ Auth::user()->state }}" v-model="fillUser.state" />
		                        <option value="">Selecione o estado</option>                                    
		                    </select>		                    
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="city">Cidade</label>
		                    <select id="city" name="city" class="form-control" value="{{ Auth::user()->city }}" v-model="fillUser.city" />
		                        <option value="">Selecione a cidade</option>                                    
		                    </select>		                    
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="education">Escolaridade</label>
		                    <select id="education" name="education" class="form-control" v-model="fillUser.education" />
		                        <option value="">Selecione o nível de escolaridade</option>
		                        <option value="Ensino Fundamental" @if(Auth::user()->education === 'Ensino Fundamental') selected="selected" @endif>Ensino Fundamental</option>
		                        <option value="Ensino Médio" @if(Auth::user()->education === 'Ensino Médio') selected="selected" @endif>Ensino Médio</option>
		                        <option value="Superior" @if(Auth::user()->education === 'Superior') selected="selected" @endif>Superior</option>
		                        <option value="Pós-graduado" @if(Auth::user()->education === 'Pós-graduado') selected="selected" @endif>Pós-graduado</option>
		                        <option value="Mestrado" selected="selected">Mestrado</option>
		                        <option value="Doutorado" @if(Auth::user()->education === 'Doutorado') selected="selected" @endif>Doutorado</option>
		                        <option value="Pós-Doutorado" @if(Auth::user()->education === 'Pós-Doutorado') selected="selected" @endif>Pós-Doutorado</option>
		                    </select>		                    
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="email">E-mail</label>
		                    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" v-model="fillUser.email" />
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="profession">Profissão</label>
		                    <input type="text" name="profession" class="form-control" value="{{ Auth::user()->profession }}" v-model="fillUser.profession" />
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="maritalStatus">Estado Civil</label>
		                    <select id="maritalStatus" name="maritalStatus" class="form-control" v-model="fillUser.maritalStatus" />
		                        <option value="">Selecione o estado civil</option>
		                        <option value="Solteiro(a)" @if(Auth::user()->maritalStatus == 'Solteiro(a)') selected="selected" @endif>Solteiro(a)</option>
		                        <option value="Casado(a)" @if(Auth::user()->maritalStatus == 'Casado(a)') selected="selected" @endif>Casado(a)</option>
		                        <option value="Separado(a)" @if(Auth::user()->maritalStatus == 'Separado(a)') selected="selected" @endif>Separado(a)</option>
		                        <option value="Divorciado(a)" @if(Auth::user()->maritalStatus == 'Divorciado(a)') selected="selected" @endif>Divorciado(a)</option>
		                        <option value="Viúvo(a)" @if(Auth::user()->maritalStatus == 'Viúvo(a)') selected="selected" @endif>Viúvo(a)</option>
		                    </select>		                    
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="religion">Religião</label>
		                    <select id="religion" name="religion" class="form-control" v-model="fillUser.religion" />
		                        <option value="">Selecione a religião</option>
		                        <option value="Adventista" @if(Auth::user()->religion === 'Adventista') selected="selected" @endif>Adventista</option>
		                        <option value="Ateìsta" @if(Auth::user()->religion === 'Ateìsta') selected="selected" @endif>Ateísta</option>
		                        <option value="Budista" @if(Auth::user()->religion === 'Budista') selected="selected" @endif>Budista</option>
		                        <option value="Católico(a)" @if(Auth::user()->religion === 'Católico(a)') selected="selected" @endif>Católico(a)</option>
		                        <option value="Candomblé" @if(Auth::user()->religion === 'Candomblé') selected="selected" @endif>Candomblé</option>
		                        <option value="Espírita" @if(Auth::user()->religion === 'Espírita') selected="selected" @endif>Espírita</option>
		                        <option value="Hinduismo" @if(Auth::user()->religion === 'Hinduismo') selected="selected" @endif>Hinduismo</option>
		                        <option value="Islamismo" @if(Auth::user()->religion === 'Islamismo') selected="selected" @endif>Islamismo</option>
		                        <option value="Judaísmo" @if(Auth::user()->religion === 'Judaísmo') selected="selected" @endif>Judaísmo</option>
		                        <option value="Messiânico" @if(Auth::user()->religion === 'Messiânico') selected="selected" @endif>Messiânico</option>
		                        <option value="Metodista" @if(Auth::user()->religion === 'Metodista') selected="selected" @endif>Metodista</option>
		                        <option value="Mórmom" @if(Auth::user()->religion === 'Mórmom') selected="selected" @endif>Mórmom</option>
		                        <option value="Ortodoxo(a)" @if(Auth::user()->religion === 'Ortodoxo(a)') selected="selected" @endif>Ortodoxo(a)</option>
		                        <option value="Presbiteriano(a)" @if(Auth::user()->religion === 'Presbiteriano(a)') selected="selected" @endif>Presbiteriano(a)</option>
		                        <option value="Protestante" @if(Auth::user()->religion === 'Protestante') selected="selected" @endif>Protestante</option>
		                        <option value="Testemunha de Jeová" @if(Auth::user()->religion === 'Testemunha de Jeová') selected="selected" @endif>Testemunha de Jeová</option>
		                        <option value="Umbanda" @if(Auth::user()->religion === 'Umbanda') selected="selected" @endif>Umbanda</option>
		                    </select>
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="ethnicity">Etnia</label>
		                    <select id="ethnicity" name="ethnicity" class="form-control" v-model="fillUser.ethnicity" />
		                        <option value="">Selecione a etnia</option>
		                        <option value="Branco(a)" @if(Auth::user()->ethnicity === 'Branco(a)') selected="selected" @endif>Branco(a)</option>
		                        <option value="Mulato(a)" @if(Auth::user()->ethnicity === 'Mulato(a)') selected="selected" @endif>Mulato(a)</option>
		                        <option value="Negro(a)" @if(Auth::user()->ethnicity === 'Negro(a)') selected="selected" @endif>Negro(a)</option>
		                        <option value="Pardo(a)" @if(Auth::user()->ethnicity === 'Pardo(a)') selected="selected" @endif>Pardo(a)</option>
		                    </select>		                    
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="income">Renda familiar</label>
		                    <select id="income" name="income" class="form-control" v-model="fillUser.income" />
		                        <option value="">Selecione a renda familiar</option>
		                        <option value="Até R$ 1.000,00" @if(Auth::user()->income === 'Até R$ 1.000,00') selected="selected" @endif>Até R$ 1.000,00</option>
		                        <option value="De R$ 1.000,01 a R$ 2.000,00" @if(Auth::user()->income === 'De R$ 1.000,01 a R$ 2.000,00') selected="selected" @endif>De R$ 1.000,01 a R$ 2.000,00</option>
		                        <option value="De R$ 2.000,01 a R$ 3.000,00" @if(Auth::user()->income === 'De R$ 2.000,01 a R$ 3.000,00') selected="selected" @endif>De R$ 2.000,01 a R$ 3.000,00</option>
		                        <option value="De R$ 3.000,01 a R$ 5.000,00" @if(Auth::user()->income === 'De R$ 3.000,01 a R$ 5.000,00') selected="selected" @endif>De R$ 3.000,01 a R$ 5.000,00</option>
		                        <option value="De R$ 5.000,01 a R$ 7.500,00" @if(Auth::user()->income === 'De R$ 5.000,01 a R$ 7.500,00') selected="selected" @endif>De R$ 5.000,01 a R$ 7.500,00</option>
		                        <option value="De R$ 7.500,01 a R$ 10.000,00" @if(Auth::user()->income === 'De R$ 7.500,01 a R$ 10.000,00') selected="selected" @endif>De R$ 7.500,01 a R$ 10.000,00</option>
		                        <option value="Acima de R$ 10.000,00" @if(Auth::user()->income === 'Acima de R$ 10.000,00') selected="selected" @endif>Acima de R$ 10.000,00</option>
		                    </select>		                    
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="sport">Pratica esporte(s)</label>
		                    <select multiple id="sport" name="sport" class="form-control" v-model="fillUser.sport" />
		                        <option value="">Selecione o(s) esporte(s)</option>
		                        <option value="Atletismo" @if(Auth::user()->sport === 'Atletismo') selected="selected" @endif>Atletismo</option>
		                        <option value="Basquete" @if(Auth::user()->sport === 'Basquete') selected="selected" @endif>Basquete</option>
		                        <option value="Ciclismo" @if(Auth::user()->sport === 'Ciclismo') selected="selected" @endif>Ciclismo</option>
		                        <option value="Equitação" @if(Auth::user()->sport === 'Equitação') selected="selected" @endif>Equitação</option>
		                        <option value="Futebol" @if(Auth::user()->sport === 'Futebol') selected="selected" @endif>Futebol</option>
		                        <option value="Ginástica" @if(Auth::user()->sport === 'Ginástica') selected="selected" @endif>Ginástica</option>
		                        <option value="Golfe" @if(Auth::user()->sport === 'Golfe') selected="selected" @endif>Golfe</option>
		                        <option value="Lutas" @if(Auth::user()->sport === 'Lutas') selected="selected" @endif>Lutas</option>
		                        <option value="Musculação" @if(Auth::user()->sport === 'Musculação') selected="selected" @endif>Musculação</option>
		                        <option value="Natação" @if(Auth::user()->sport === 'Natação') selected="selected" @endif>Natação</option>
		                        <option value="Skate" @if(Auth::user()->sport === 'Skate') selected="selected" @endif>Skate</option>
		                        <option value="Surf" @if(Auth::user()->sport === 'Surf') selected="selected" @endif>Surf</option>
		                        <option value="Tênis" @if(Auth::user()->sport === 'Tênis') selected="selected" @endif>Tênis</option>
		                        <option value="Vôlei" @if(Auth::user()->sport === 'Vôlei') selected="selected" @endif>Vôlei</option>
		                        <option value="Outros" @if(Auth::user()->sport === 'Outros') selected="selected" @endif>Outros</option>
		                    </select>		                    
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="soccerTeam">Time de futebol</label>
		                    <select id="soccerTeam" name="soccerTeam" class="form-control" v-model="fillUser.soccerTeam" />
		                        <option value="">Selecione o seu time de futebol</option>
		                        <option value="ABC" @if(Auth::user()->soccerTeam === 'ABC') selected="selected" @endif>ABC</option>
		                        <option value="América-MG" @if(Auth::user()->soccerTeam === 'América-MG') selected="selected" @endif>América-MG</option>
		                        <option value="América-RN" @if(Auth::user()->soccerTeam === 'América-RN') selected="selected" @endif>América-RN</option>
		                        <option value="Atlético-GO" @if(Auth::user()->soccerTeam === 'Atlético-GO') selected="selected" @endif>Atlético-GO</option>
		                        <option value="Atlético-MG" @if(Auth::user()->soccerTeam === 'Atlético-MG') selected="selected" @endif>Atlético-MG</option>
		                        <option value="Atlético-PR" @if(Auth::user()->soccerTeam === 'Atlético-PR') selected="selected" @endif>Atlético-PR</option>
		                        <option value="Avaí" @if(Auth::user()->soccerTeam === 'Avaí') selected="selected" @endif>Avaí</option>
		                        <option value="Bahia" @if(Auth::user()->soccerTeam === 'Bahia') selected="selected" @endif>Bahia</option>
		                        <option value="Botafogo" @if(Auth::user()->soccerTeam === 'Botafogo') selected="selected" @endif>Botafogo</option>
		                        <option value="Ceará" @if(Auth::user()->soccerTeam === 'Ceará') selected="selected" @endif>Ceará</option>
		                        <option value="Chapecoense" @if(Auth::user()->soccerTeam === 'Chapecoense') selected="selected" @endif>Chapecoense</option>
		                        <option value="Corinthians" @if(Auth::user()->soccerTeam === 'Corinthians') selected="selected" @endif>Corinthians</option>
		                        <option value="Coritiba" @if(Auth::user()->soccerTeam === 'Coritiba') selected="selected" @endif>Coritiba</option>
		                        <option value="CRB" @if(Auth::user()->soccerTeam === 'CRB') selected="selected" @endif>CRB</option>
		                        <option value="Cricíúma" @if(Auth::user()->soccerTeam === 'Cricíúma') selected="selected" @endif>Cricíúma</option>
		                        <option value="Cruzeiro" @if(Auth::user()->soccerTeam === 'Cruzeiro') selected="selected" @endif>Cruzeiro</option>
		                        <option value="Figueirense" @if(Auth::user()->soccerTeam === 'Figueirense') selected="selected" @endif>Figueirense</option>
		                        <option value="Flamengo" @if(Auth::user()->soccerTeam === 'Flamengo') selected="selected" @endif>Flamengo</option>
		                        <option value="Fluminense" @if(Auth::user()->soccerTeam === 'Fluminense') selected="selected" @endif>Fluminense</option>
		                        <option value="Fortaleza" @if(Auth::user()->soccerTeam === 'Fortaleza') selected="selected" @endif>Fortaleza</option>
		                        <option value="Goiás" @if(Auth::user()->soccerTeam === 'Goiás') selected="selected" @endif>Goiás</option>
		                        <option value="Grêmio" @if(Auth::user()->soccerTeam === 'Grêmio') selected="selected" @endif>Grêmio</option>
		                        <option value="Guarani" @if(Auth::user()->soccerTeam === 'Guarani') selected="selected" @endif>Guarani</option>
		                        <option value="Internacional" @if(Auth::user()->soccerTeam === 'Internacional') selected="selected" @endif>Internacional</option>
		                        <option value="Juventude" @if(Auth::user()->soccerTeam === 'Juventude') selected="selected" @endif>Juventude</option>
		                        <option value="Náutico" @if(Auth::user()->soccerTeam === 'Náutico') selected="selected" @endif>Náutico</option>
		                        <option value="Palmeiras" @if(Auth::user()->soccerTeam === 'Palmeiras') selected="selected" @endif>Palmeiras</option>
		                        <option value="Paraná" @if(Auth::user()->soccerTeam === 'Paraná') selected="selected" @endif>Paraná</option>
		                        <option value="Ponte Preta" @if(Auth::user()->soccerTeam === 'Ponte Preta') selected="selected" @endif>Ponte Preta</option>
		                        <option value="Portuguesa" @if(Auth::user()->soccerTeam === 'Feminino') selected="selected" @endif>Portuguesa</option>
		                        <option value="Paysandu" @if(Auth::user()->soccerTeam === 'Paysandu') selected="selected" @endif>Paysandu</option>
		                        <option value="Santa Cruz" @if(Auth::user()->soccerTeam === 'Santa Cruz') selected="selected" @endif>Santa Cruz</option>
		                        <option value="Santos" @if(Auth::user()->soccerTeam === 'Santos') selected="selected" @endif>Santos</option>
		                        <option value="São Paulo" @if(Auth::user()->soccerTeam === 'São Paulo') selected="selected" @endif>São Paulo</option>
		                        <option value="Sport" @if(Auth::user()->soccerTeam === 'Sport') selected="selected" @endif>Sport</option>
		                        <option value="Vasco" @if(Auth::user()->soccerTeam === 'Vasco') selected="selected" @endif>Vasco</option>
		                        <option value="Vitória" @if(Auth::user()->soccerTeam === 'Vitória') selected="selected" @endif>Vitória</option>
		                        <option value="Outro" @if(Auth::user()->soccerTeam === 'Outro') selected="selected" @endif>Outro</option>
		                    </select>		                    
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="height">Altura(m)</label>
		                    <input type="text" name="height" class="form-control" value="{{ Auth::user()->height }}" maxlength="4" onkeypress="formatHeight(this)" v-model="fillUser.height" />		                    
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="weight">Peso(kg)</label>
		                    <input type="text" name="weight" class="form-control" value="{{ Auth::user()->weight }}" maxlength="3" onkeypress="formatWeight(this,event)" v-model="fillUser.weight" />		                    
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="hasCar">Possui automóvel?</label>
		                    <select id="hasCar" name="hasCar" class="form-control" v-model="fillUser.hasCar" />
		                        <option value="">Selecione a melhor opção</option>
		                        <option value="0" @if(Auth::user()->hasCar == 0) selected="selected" @endif>Não</option>
		                        <option value="1" @if(Auth::user()->hasCar == 1) selected="selected" @endif>Sim</option>                                    
		                    </select>		                    
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="hasChildren">Possui filhos?</label>
		                    <select id="hasChildren" name="hasChildren" class="form-control" v-model="fillUser.hasChildren" />
		                        <option value="">Selecione a melhor opção</option>
		                        <option value="0" @if(Auth::user()->hasChildren == 0) selected="selected" @endif>Não</option>
		                        <option value="1" @if(Auth::user()->hasChildren == 1) selected="selected" @endif>Sim</option>                                 
		                    </select>		                    
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="liveWith">Mora com quem?</label>
		                    <select id="liveWith" name="liveWith" class="form-control" v-model="fillUser.liveWith" />
		                        <option value="">Selecione a melhor opção</option>
		                        <option value="Com a família" @if(Auth::user()->liveWith === 'Com a família') selected="selected" @endif>Com a família</option>
		                        <option value="Com amigos ou colegas" @if(Auth::user()->liveWith === 'Com amigos ou colegas') selected="selected" @endif>Com amigos ou colegas</option>
		                        <option value="Sozinho" @if(Auth::user()->liveWith === 'Sozinho') selected="selected" @endif>Sozinho</option>
		                    </select>		                    
		                </div>
		                <div class="form-group col-lg-4 profile-item">
		                    <label for="pet">Possui animal(ais) de estimação?</label>
		                    <select multiple id="pet" name="pet" class="form-control" v-model="fillUser.pet" />
		                        <option value="">Selecione o(s) animal(ais) de estimação</option>
		                        <option value="Aves" @if(Auth::user()->pet === 'Aves') selected="selected" @endif>Aves</option>
		                        <option value="Cachorro" @if(Auth::user()->pet === 'Cachorro') selected="selected" @endif>Cachorro</option>
		                        <option value="Gato" @if(Auth::user()->pet === 'Gato') selected="selected" @endif>Gato</option>
		                        <option value="Peixe" @if(Auth::user()->pet === 'Peixe') selected="selected" @endif>Peixe</option>
		                        <option value="Outros" @if(Auth::user()->pet === 'Outros') selected="selected" @endif>Outros</option>
		                    </select>		                    
		                </div>
		                <div class="form-group">
		                    <button type="submit" class="btn btn-primary">Atualizar Dados</button>
		                </div>
		            </form>        
		        </div>
            </div>
        </div>
    </div>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/vue.resource/0.9.3/vue-resource.min.js"></script>
    <script type="text/javascript" src="/js/app-users.js"></script>
@endsection