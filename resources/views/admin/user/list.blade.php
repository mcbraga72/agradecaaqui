@extends('admin.dashboard')
@section('content')
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
    <div class="container administrators" id="users">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createUser"><i class="fa fa-plus fa-fw"></i>Cadastrar usuário</button>
                    <input type="text" class="form-data" placeholder=" Localizar" v-model="filterTerm" style="" />
                </div>
            </div>
        </div>

        <!-- User Listing -->
        <table class="table table-bordered table-striped">
            <tr>
                <th><a href="#" @click="sort($event, 'name')">Nome</a></th>
                <th>E-mail</th>
                <th colspan="2">Ação</th>
            </tr>
            <tr v-for="user in users | filterBy filterTerm | orderBy sortProperty sortDirection">
                <td>@{{ user.name }}</td>
                <td>@{{ user.email }}</td>
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

        <!-- Edit User Modal -->
        <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
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
                                <br>
                                <label class="radio-inline">
                                    <input type="radio" class="form-control radio-register" id="gender" name="gender" value="masculino" v-model="fillUser.gender" v-bind:checked="{ fillUser.gender == 'masculino' }">MASCULINO
                                </label>
                                <label class="radio-inline">    
                                    <input type="radio" class="form-control radio-register" id="gender" name="gender" value="feminino" v-model="fillUser.gender" v-bind:checked="{ fillUser.gender == 'feminino' }">FEMININO
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" class="form-control radio-register" id="gender" name="gender" value="outros" v-model="fillUser.gender" v-bind:checked="{ fillUser.gender == 'outros' }">OUTROS
                                </label>                                
                                <span v-if="formErrorsUpdate['gender']" class="error text-danger">@{{ formErrorsUpdate['gender'] }}</span>
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
                                <label for="state">Estado:</label>
                                <select id="stateUpdate" name="state" class="form-control" v-model="fillUser.state" />
                                    <option value="">Selecione o estado</option>                                    
                                </select>                                
                                <span v-if="formErrorsUpdate['state']" class="error text-danger">@{{ formErrorsUpdate['state'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="city">Cidade:</label>
                                <select id="cityUpdate" name="city" class="form-control" v-model="fillUser.city" />
                                    <option value="">Selecione o estado</option>                                    
                                </select>                                
                                <span v-if="formErrorsUpdate['city']" class="error text-danger">@{{ formErrorsUpdate['city'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="name">E-mail:</label>
                                <input type="email" name="email" class="form-control" v-model="fillUser.email" />
                                <span v-if="formErrorsUpdate['email']" class="error text-danger">@{{ formErrorsUpdate['email'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="password">Senha:</label>
                                <input type="password" name="password" class="form-control" v-model="fillUser.password" />
                                <span v-if="formErrorsUpdate['password']" class="error text-danger">@{{ formErrorsUpdate['password'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">Confirmar Senha:</label>
                                <input type="password" name="password-confirm" class="form-control" v-model="fillUser.password" />
                                <span v-if="formErrorsUpdate['password-confirm']" class="error text-danger">@{{ formErrorsUpdate['password-confirm'] }}</span>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/vue.resource/0.9.3/vue-resource.min.js"></script>
    <script type="text/javascript" src="/js/admin-users.js"></script>
@endsection
