@extends('admin.layout')
@section('content')
    <script type="text/javascript"> 
            
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
    <div class="container administrators" id="users">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="item-title">Cadastro de Usuários</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createUser"><i class="fa fa-plus fa-fw"></i>Cadastrar usuário</button>
                    <a href="/admin/cadastro/usuarios/exportar" class="btn btn-primary"><i class="fa fa-file-excel-o fa-fw"></i>Exportar cadastro</a>
                    <input type="text" class="form-data search-box" placeholder=" Localizar" v-model="filterTerm" />                    
                </div>
            </div>
        </div>

        <!-- User Listing -->
        <table class="table table-bordered table-striped">
            <tr>
                <th><a href="#" @click="sort($event, 'name')">Nome</a></th>
                <th>E-mail</th>
                <th>Tipo de cadastro</th>
                <th colspan="2">Ação</th>
            </tr>
            <tr v-for="user in users | filterBy filterTerm | orderBy sortProperty sortDirection">
                <td>@{{ user.name }}</td>
                <td>@{{ user.email }}</td>
                <td>@{{ user.registerType }}</td>
                <td>    
                    <button class="btn btn-primary" @click.prevent="editUser(user)"><i class="fa fa-pencil-square-o fa-fw"></i>Editar</button>
                    <button class="btn btn-danger" @click.prevent="deleteUser(user)"><i class="fa fa-trash-o fa-fw"></i>Remover</button>
                </td>
            </tr>
        </table>

        <!-- Pagination -->
        <nav>
            <ul class="pagination">
                <li v-if="pagination.current_page > 1">
                    <a href="#" aria-label="Previous"
                       @click.prevent="changePage(pagination.current_page - 1)">
                        <span aria-hidden="true">«</span>
                    </a>
                </li>
                <li v-for="page in pagesNumber"
                    v-bind:class="[ page == isActived ? 'active' : '']">
                    <a href="#"
                       @click.prevent="changePage(page)">@{{ page }}</a>
                </li>
                <li v-if="pagination.current_page < pagination.last_page">
                    <a href="#" aria-label="Next"
                       @click.prevent="changePage(pagination.current_page + 1)">
                        <span aria-hidden="true">»</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Create User Modal -->
        <div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-name" id="myModalLabel">Cadastro de usuários</h4>
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
                                <select id="gender" name="gender" class="form-control" v-model="newUser.gender" />
                                    <option value="">Selecione o sexo</option>
                                    <option value="Feminino">Feminino</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Outros">Outros</option>
                                </select>                                
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
                                <select id="state" name="state" class="form-control" v-model="newUser.state" />
                                    <option value="">Selecione o estado</option>
                                    <option value="Acre">Acre</option>
                                    <option value="Alagoas">Alagoas</option>
                                    <option value="Amapá">Amapá</option>
                                    <option value="Amazonas">Amazonas</option>
                                    <option value="Bahia">Bahia</option>
                                    <option value="Ceará">Ceará</option>
                                    <option value="Distrito Federal">Distrito Federal</option>
                                    <option value="Espírito Santo">Espírito Santo</option>
                                    <option value="Goiás">Goiás</option>
                                    <option value="Maranhão">Maranhão</option>
                                    <option value="Mato Grosso">Mato Grosso</option>
                                    <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                                    <option value="Minas Gerais">Minas Gerais</option>
                                    <option value="Pará">Pará</option>
                                    <option value="Paraíba">Paraíba</option>
                                    <option value="Paraná">Paraná</option>
                                    <option value="Pernambuco">Pernambuco</option>
                                    <option value="Piauí">Piauí</option>                        
                                    <option value="Rio de Janeiro">Rio de Janeiro</option>
                                    <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                                    <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                                    <option value="Rondônia">Rondônia</option>
                                    <option value="Roraima">Roraima</option>
                                    <option value="Santa Catarina">Santa Catarina</option>
                                    <option value="Sergipe">Sergipe</option>
                                    <option value="São Paulo">São Paulo</option>
                                    <option value="Tocantins">Tocantins</option>
                                </select>                                
                                <span v-if="formErrors['state']" class="error text-danger">@{{ formErrors['state'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="city">Cidade:</label>
                                <select id="city" name="city" class="form-control" v-model="newUser.city" />
                                    <option value="">Selecione a cidade</option>
                                    <option v-for="option in options" v-bind:value="option">@{{ option }}</option>
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
                                <label for="passwordConfirm">Confirmar Senha:</label>
                                <input type="password" name="passwordConfirm" class="form-control" v-model="newUser.passwordConfirm" />
                                <span v-if="formErrors['passwordConfirm']" class="error text-danger">@{{ formErrors['passwordConfirm'] }}</span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit User Modal -->
        <div class="modal fade col-lg-8 col-lg-offset-2" id="editUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">        
            <div class="modal-admin col-lg-12 col-lg-offset-0" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-name" id="myModalLabel">Editar perfil</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateUser(fillUser.id)">
                            <div class="form-group">
                                <label for="name">Nome:</label>
                                <input type="text" name="name" class="form-control" v-model="fillUser.name" />
                                <span v-if="formErrorsUpdate['name']" class="error text-danger">@{{ formErrorsUpdate['name'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="surName">Sobrenome:</label>
                                <input type="text" name="surName" class="form-control" v-model="fillUser.surName" />
                                <span v-if="formErrorsUpdate['surName']" class="error text-danger">@{{ formErrorsUpdate['surName'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="gender">Sexo:</label>
                                <select id="gender" name="gender" class="form-control" v-model="fillUser.gender" />
                                    <option value="">Selecione o sexo</option>
                                    <option value="Feminino">Feminino</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Outros">Outros</option>
                                </select>                                
                                <span v-if="formErrorsUpdate['gender']" class="error text-danger">@{{ formErrorsUpdate['gender'] }}</span><br>
                                <input type="text" name="otherGender" class="form-control formShow" v-model="fillUser.otherGender" v-bind:class="{formShow: fillUser.gender == 'Outros', 'formHide': fillUser.gender != 'Outros'}" />
                            </div>
                            <div class="form-group">
                                <label for="dateOfBirth">Data de nascimento:</label>
                                <input type="text" id="dateOfBirth" name="dateOfBirth" class="form-control" v-model="fillUser.dateOfBirth" maxlength="10" onkeypress="formatDateOfBirth(this)" />
                                <span v-if="formErrorsUpdate['dateOfBirth']" class="error text-danger">@{{ formErrorsUpdate['dateOfBirth'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="telephone">Celular:</label>
                                <input type="text" id="telephone" name="telephone" class="form-control" v-model="fillUser.telephone" maxlength="15" onkeypress="formatCellphone(this)" />
                                <span v-if="formErrorsUpdate['telephone']" class="error text-danger">@{{ formErrorsUpdate['telephone'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="country">País</label>
                                <select id="country" name="country" class="form-control" v-model="fillUser.country" />
                                    <option value="">Selecione o país</option>
                                    @foreach($countries as $country)
                                        @if($country == $country)
                                            <option value="{{ $country }}" selected="selected">{{ $country }}</option>
                                        @else
                                            <option value="{{ $country }}">{{ $country }}</option>
                                        @endif  
                                    @endforeach
                                </select>
                                <span v-if="formErrorsCompleteRegister['country']" class="error text-danger">@{{ formErrorsCompleteRegister['country'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="state">Estado:</label>
                                <select id="stateUpdate" name="state" class="form-control" v-model="fillUser.state" />
                                    <option value="">Selecione o estado</option>
                                    <option value="Acre">Acre</option>
                                    <option value="Alagoas">Alagoas</option>
                                    <option value="Amapá">Amapá</option>
                                    <option value="Amazonas">Amazonas</option>
                                    <option value="Bahia">Bahia</option>
                                    <option value="Ceará">Ceará</option>
                                    <option value="Distrito Federal">Distrito Federal</option>
                                    <option value="Espírito Santo">Espírito Santo</option>
                                    <option value="Goiás">Goiás</option>
                                    <option value="Maranhão">Maranhão</option>
                                    <option value="Mato Grosso">Mato Grosso</option>
                                    <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                                    <option value="Minas Gerais">Minas Gerais</option>
                                    <option value="Pará">Pará</option>
                                    <option value="Paraíba">Paraíba</option>
                                    <option value="Paraná">Paraná</option>
                                    <option value="Pernambuco">Pernambuco</option>
                                    <option value="Piauí">Piauí</option>                        
                                    <option value="Rio de Janeiro">Rio de Janeiro</option>
                                    <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                                    <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                                    <option value="Rondônia">Rondônia</option>
                                    <option value="Roraima">Roraima</option>
                                    <option value="Santa Catarina">Santa Catarina</option>
                                    <option value="Sergipe">Sergipe</option>
                                    <option value="São Paulo">São Paulo</option>
                                    <option value="Tocantins">Tocantins</option>
                                </select>                                
                                <span v-if="formErrorsUpdate['state']" class="error text-danger">@{{ formErrorsUpdate['state'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="city">Cidade:</label>
                                <select id="cityUpdate" name="city" class="form-control" v-model="fillUser.city" />
                                    <option value="">Selecione o estado</option>     
                                    <option v-for="editOption in editOptions" v-bind:value="editOption" selected="@{{fillUser.city == editOption}}">@{{ editOption }}</option>
                                </select>                                
                                <span v-if="formErrorsUpdate['city']" class="error text-danger">@{{ formErrorsUpdate['city'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="education">Escolaridade</label>
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
                            <div class="form-group">
                                <label for="name">E-mail:</label>
                                <input type="email" name="email" class="form-control" v-model="fillUser.email" />
                                <span v-if="formErrorsUpdate['email']" class="error text-danger">@{{ formErrorsUpdate['email'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="profession">Profissão</label>
                                <input type="text" name="profession" class="form-control" v-model="fillUser.profession" />
                                <span v-if="formErrorsCompleteRegister['profession']" class="error text-danger">@{{ formErrorsCompleteRegister['profession'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="maritalStatus">Estado Civil</label>
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
                            <div class="form-group">
                                <label for="religion">Religião</label>
                                <select id="religion" name="religion" class="form-control" v-model="fillUser.religion" />
                                    <option value="">Selecione a religião</option>
                                    <option value="Adventista">Adventista</option>
                                    <option value="Ateìsta">Ateísta</option>
                                    <option value="Budista">Budista</option>
                                    <option value="Católico(a)">Católico(a)</option>
                                    <option value="Candomblé">Candomblé</option>
                                    <option value="Espírita">Espírita</option>
                                    <option value="Hinduismo">Hinduismo</option>
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
                                    <option value="Outra">Outra</option>
                                </select>
                                <span v-if="formErrorsCompleteRegister['religion']" class="error text-danger">@{{ formErrorsCompleteRegister['religion'] }}</span><br>
                                <input type="text" name="otherReligion" class="form-control formShow" v-model="fillUser.otherReligion" v-bind:class="{formShow: fillUser.religion == 'Outra', 'formHide': fillUser.religion != 'Outra'}" />
                            </div>
                            <div class="form-group">
                                <label for="income">Renda familiar</label>
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
                            <div class="form-group">
                                <label for="sport">Pratica esporte(s)</label>
                                <select multiple id="sport" name="sport" class="form-control" v-model="fillUser.sport" />
                                    <option value="">Selecione o(s) esporte(s)</option>
                                    <option value="Nenhum">Nenhum</option>
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
                                    <option value="Outro(s)">Outro(s)</option>
                                </select>
                                <span v-if="formErrorsCompleteRegister['sport']" class="error text-danger">@{{ formErrorsCompleteRegister['sport'] }}</span><br>
                                <input type="text" name="otherSport" class="form-control formShow" v-bind:class="{formShow: fillUser.sport == 'Outro(s)', 'formHide': fillUser.sport != 'Outro(s)'}" />
                            </div>
                            <div class="form-group">
                                <label for="soccerTeam">Time de futebol</label>
                                <select id="soccerTeam" name="soccerTeam" class="form-control" v-model="fillUser.soccerTeam" />
                                    <option value="">Selecione o seu time de futebol</option>
                                    <option value="Nenhum">Nenhum</option>
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
                                <span v-if="formErrorsCompleteRegister['soccerTeam']" class="error text-danger">@{{ formErrorsCompleteRegister['soccerTeam'] }}</span><br>
                                <input type="text" name="otherSoccerTeam" class="form-control formShow" v-model="fillUser.otherSoccerTeam" v-bind:class="{formShow: fillUser.soccerTeam == 'Outro', 'formHide': fillUser.soccerTeam != 'Outro'}" />                                
                            </div>
                            <div class="form-group">
                                <label for="height">Altura(m)</label>
                                <input type="text" name="height" class="form-control" maxlength="4" onkeypress="formatHeight(this)" v-model="fillUser.height" />
                                <span v-if="formErrorsCompleteRegister['height']" class="error text-danger">@{{ formErrorsCompleteRegister['height'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="weight">Peso(kg)</label>
                                <input type="text" name="weight" class="form-control" maxlength="3" onkeypress="formatWeight(this,event)" v-model="fillUser.weight" />
                                <span v-if="formErrorsCompleteRegister['weight']" class="error text-danger">@{{ formErrorsCompleteRegister['weight'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="hasCar">Possui automóvel?</label>
                                <select id="hasCar" name="hasCar" class="form-control" v-model="fillUser.hasCar" />
                                    <option value="">Selecione a melhor opção</option>
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                                <span v-if="formErrorsCompleteRegister['hasCar']" class="error text-danger">@{{ formErrorsCompleteRegister['hasCar'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="hasChildren">Possui filhos?</label>
                                <select id="hasChildren" name="hasChildren" class="form-control" v-model="fillUser.hasChildren" />
                                    <option value="">Selecione a melhor opção</option>
                                    <option value="0">Não</option>
                                    <option value="1">Sim</option>
                                </select>
                                <span v-if="formErrorsCompleteRegister['hasChildren']" class="error text-danger">@{{ formErrorsCompleteRegister['hasChildren'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="liveWith">Mora com quem?</label>
                                <select id="liveWith" name="liveWith" class="form-control" v-model="fillUser.liveWith" />
                                    <option value="">Selecione a melhor opção</option>
                                    <option value="Com a família">Com a família</option>
                                    <option value="Com amigos ou colegas">Com amigos ou colegas</option>
                                    <option value="Sozinho">Sozinho</option>
                                </select>
                                <span v-if="formErrorsCompleteRegister['liveWith']" class="error text-danger">@{{ formErrorsCompleteRegister['liveWith'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="pet">Possui animal(ais) de estimação?</label>
                                <select multiple id="pet" name="pet" class="form-control" v-model="fillUser.pet" />
                                    <option value="">Selecione o(s) animal(ais) de estimação</option>
                                    <option value="Aves">Aves</option>
                                    <option value="Cachorro">Cachorro</option>
                                    <option value="Gato">Gato</option>
                                    <option value="Peixe">Peixe</option>
                                    <option value="Outro(s)">Outro(s)</option>
                                </select>
                                <span v-if="formErrorsCompleteRegister['pet']" class="error text-danger">@{{ formErrorsCompleteRegister['pet'] }}</span><br>
                                <input type="text" name="otherPet" class="form-control formShow" v-model="fillUser.otherPet" v-bind:class="{formShow: fillUser.pet == 'Outro(s)', 'formHide': fillUser.pet != 'Outro(s)'}" />                                                         
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
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/vue.resource/0.9.3/vue-resource.min.js"></script>
    <script type="text/javascript" src="/js/admin-users.js"></script>
@endsection
