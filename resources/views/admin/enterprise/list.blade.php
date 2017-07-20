@extends('admin.layout')
@section('content')
    <div class="container administrators" id="enterprises">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="item-title">Cadastro de Empresas</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createEnterprise"><i class="fa fa-plus fa-fw"></i>Cadastrar empresa</button>
                    <a href="/admin/cadastro/empresas/exportar" class="btn btn-primary"><i class="fa fa-file-excel-o fa-fw"></i>Exportar cadastro</a>
                    <input type="text" class="form-data search-box" placeholder=" Localizar" v-model="filterTerm" />
                </div>
            </div>
        </div>

        <!-- Enterprise Listing -->        
        <table class="table table-bordered table-striped">
            <tr>
                <th><a href="#" @click="sort($event, 'enterprises.name')">Empresa</a></th>
                <th>Contato</th>
                <th>E-mail</th>
                <th>Perfil</th>
                <th colspan="2">Ação</th>
            </tr>
            <tr v-for="enterprise in enterprises | filterBy filterTerm | orderBy sortProperty sortDirection">
                <td>@{{ enterprise.name }}</td>
                <td>@{{ enterprise.contact }}</td>
                <td>@{{ enterprise.email }}</td>
                <td>@{{ enterprise.profile }}</td>
                <td>    
                    <button class="btn btn-primary" @click.prevent="editEnterprise(enterprise)"><i class="fa fa-pencil-square-o fa-fw"></i>Editar</button>
                    <button class="btn btn-danger" @click.prevent="deleteEnterprise(enterprise)"><i class="fa fa-trash-o fa-fw"></i>Remover</button>
                    <button class="btn btn-success" @click.prevent="resetPassword(enterprise)"><i class="fa fa-key fa-fw"></i>Alterar Senha</button>
                    <button class="btn btn-success" @click.prevent="approveEnterpriseRegister(enterprise)" v-if="enterprise.status == 'Pending'"><i class="fa fa-check fa-fw"></i>Aprovar Cadastro</button>
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

        <!-- Create Enterprise Modal -->
        <div class="modal fade" id="createEnterprise" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-name" id="myModalLabel">Cadastro de empresas</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createEnterprise">
                            <div class="form-group">
                                <label for="category_id">Categoria:</label>
                                <select name="category_id" class="form-control" v-model="newEnterprise.category_id" />
                                    <option value="">Selecione a categoria</option>
                                    <option value="@{{ category.id }}" v-for="category in categories">@{{ category.name }}</option>
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
                                <label for="name">Site:</label>
                                <input type="text" name="site" class="form-control" v-model="newEnterprise.site" />
                                <span v-if="formErrors['site']" class="error text-danger">@{{ formErrors['site'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="telephone">Telefone:</label>
                                <input type="text" name="telephone" class="form-control" v-model="newEnterprise.telephone" maxlength="15" onkeypress="formatTelephone(this)" />
                                <span v-if="formErrors['telephone']" class="error text-danger">@{{ formErrors['telephone'] }}</span>
                            </div>                            
                            <div class="form-group">
                                <label for="state">Estado:</label>
                                <select name="state" id="state" class="form-control" v-model="newEnterprise.state" v-on:change="onChange">
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
                                <select name="city" id="city" class="form-control" v-model="newEnterprise.city">
                                    <option v-for="option in options" v-bind:value="option">@{{ option }}</option>
                                </select>
                                <span v-if="formErrors['city']" class="error text-danger">@{{ formErrors['city'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="neighborhood">Bairro:</label>
                                <input type="text" name="neighborhood" class="form-control" v-model="newEnterprise.neighborhood" />
                                <span v-if="formErrors['neighborhood']" class="error text-danger">@{{ formErrors['neighborhood'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="address">Endereço:</label>
                                <input type="text" name="address" class="form-control" v-model="newEnterprise.address" />
                                <span v-if="formErrors['address']" class="error text-danger">@{{ formErrors['address'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="type">Tipo:</label><br>
                                <input type="radio" name="type" value="pf">Pessoa Física<br>
                                <input type="radio" name="type" value="pj">Pessoa Jurídica<br>
                            </div>
                            <div class="form-group">
                                <label for="cpf" id="cpfLabel">CPF:</label>
                                <input type="text" id="cpf" name="cpf" class="form-control" v-model="newEnterprise.cpf" maxlength="14" onkeypress="return formatCPF(this, event)" />
                                <span v-if="formErrors['cpf']" class="error text-danger">@{{ formErrors['cpf'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="cnpj" id="cnpjLabel">CNPJ:</label>
                                <input type="text" id="cnpj" name="cnpj" class="form-control" v-model="newEnterprise.cnpj" maxlength="18" onkeypress="return formatCNPJ(this, event)" />
                                <span v-if="formErrors['cnpj']" class="error text-danger">@{{ formErrors['cnpj'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="password">Senha:</label>
                                <input type="password" name="password" class="form-control" v-model="newEnterprise.password" />
                                <span v-if="formErrors['password']" class="error text-danger">@{{ formErrors['password'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="passwordConfirm">Confirmar Senha:</label>
                                <input type="password" name="passwordConfirm" class="form-control" v-model="newEnterprise.passwordConfirm" />
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

        <!-- Edit Enterprise Modal -->
        <div class="modal fade" id="editEnterprise" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-name" id="myModalLabel">Editar dados da empresa</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateEnterprise(fillEnterprise.id)">
                            <div class="form-group">
                                <label for="category_id">Categoria:</label>
                                <select name="category_id" class="form-control" v-model="fillEnterprise.category_id" />
                                    <option value="">Selecione a categoria</option>
                                    <option value="@{{ category.id }}" v-for="category in categories">@{{ category.name }}</option>
                                </select>
                                <span v-if="formErrorsUpdate['category_id']" class="error text-danger">@{{ formErrorsUpdate['category_id'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="name">Nome:</label>
                                <input type="text" name="name" class="form-control" v-model="fillEnterprise.name" />
                                <span v-if="formErrorsUpdate['name']" class="error text-danger">@{{ formErrorsUpdate['name'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contato:</label>
                                <input type="text" name="contact" class="form-control" v-model="fillEnterprise.contact" />
                                <span v-if="formErrorsUpdate['contact']" class="error text-danger">@{{ formErrorsUpdate['contact'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="name">E-mail:</label>
                                <input type="email" name="email" class="form-control" v-model="fillEnterprise.email" />
                                <span v-if="formErrorsUpdate['email']" class="error text-danger">@{{ formErrorsUpdate['email'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="name">Site:</label>
                                <input type="text" name="site" class="form-control" v-model="fillEnterprise.site" />
                                <span v-if="formErrorsUpdate['site']" class="error text-danger">@{{ formErrorsUpdate['site'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="telephone">Telefone:</label>
                                <input type="text" name="telephone" class="form-control" v-model="fillEnterprise.telephone" maxlength="15" onkeypress="formatTelephone(this)" />
                                <span v-if="formErrorsUpdate['telephone']" class="error text-danger">@{{ formErrorsUpdate['telephone'] }}</span>
                            </div>                            
                            <div class="form-group">
                                <label for="state">Estado:</label>
                                <select name="state" id="state" class="form-control" v-model="fillEnterprise.state" v-on:change="onChange">
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
                                <select name="city" id="city" class="form-control" v-model="fillEnterprise.city">
                                    <option v-for="editOption in editOptions" v-bind:value="editOption" selected="@{{fillEnterprise.city == editOption}}">@{{ editOption }}</option>
                                </select>
                                <span v-if="formErrorsUpdate['city']" class="error text-danger">@{{ formErrorsUpdate['city'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="neighborhood">Bairro:</label>
                                <input type="text" name="neighborhood" class="form-control" v-model="fillEnterprise.neighborhood" />
                                <span v-if="formErrorsUpdate['neighborhood']" class="error text-danger">@{{ formErrorsUpdate['neighborhood'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="address">Endereço:</label>
                                <input type="text" name="address" class="form-control" v-model="fillEnterprise.address" />
                                <span v-if="formErrorsUpdate['address']" class="error text-danger">@{{ formErrorsUpdate['address'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="type">Tipo:</label><br>
                                <input type="radio" name="typeEdit" value="pf">Pessoa Física<br>
                                <input type="radio" name="typeEdit" value="pj" checked="checked">Pessoa Jurídica<br>
                            </div>
                            <div class="form-group">
                                <label for="cpf">CPF:</label>
                                <input type="text" name="cpf" class="form-control" v-model="fillEnterprise.cpf" maxlength="14" onkeypress="return formatCPF(this, event)" />
                                <span v-if="formErrorsUpdate['cpf']" class="error text-danger">@{{ formErrorsUpdate['cpf'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="cnpj">CNPJ:</label>
                                <input type="text" name="cnpj" class="form-control" v-model="fillEnterprise.cnpj" maxlength="18" onkeypress="return formatCNPJ(this, event)" />
                                <span v-if="formErrorsUpdate['cnpj']" class="error text-danger">@{{ formErrorsUpdate['cnpj'] }}</span>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#cnpjLabel').hide();
            $('#cnpj').hide();
        });

        $('input[name=type]').on('click', function(e) {
            if ($('input[name=type]:checked').val() == 'pj') {
                $('#cnpjLabel').show();
                $('#cnpj').show();
                $('#cpfLabel').hide();
                $('#cpf').hide();
            } else {                
                $('#cpfLabel').show();
                $('#cpf').show();
                $('#cnpjLabel').hide();
                $('#cnpj').hide();
            }
        });

        function formatTelephone(telephone){ 
            if(telephone.value.length == 0)
                telephone.value = '(' + telephone.value;
            if(telephone.value.length == 3)
                telephone.value = telephone.value + ') ';
            if(telephone.value.length == 10)
                telephone.value = telephone.value + '-';  
        }

        function formatCPF(cpf, evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            } else {
                if(cpf.value.length == 3)
                    cpf.value = cpf.value + '.';
                if(cpf.value.length == 7)
                    cpf.value = cpf.value + '.';
                if(cpf.value.length == 11)
                    cpf.value = cpf.value + '-';
                return true;
            }
        }

        function formatCNPJ(cnpj, evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            } else {
                if(cnpj.value.length == 2)
                    cnpj.value = cnpj.value + '.';
                if(cnpj.value.length == 6)
                    cnpj.value = cnpj.value + '.';
                if(cnpj.value.length == 10)
                    cnpj.value = cnpj.value + '/';
                if(cnpj.value.length == 15)
                    cnpj.value = cnpj.value + '-';
                return true;
            }
        }
    </script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/vue.resource/0.9.3/vue-resource.min.js"></script>
    <script type="text/javascript" src="/js/admin-enterprises.js"></script>
@endsection
