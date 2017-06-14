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
                                <label for="address">Endereço:</label>
                                <input type="text" name="address" class="form-control" v-model="newEnterprise.address" />
                                <span v-if="formErrors['address']" class="error text-danger">@{{ formErrors['address'] }}</span>
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
                                <label for="address">Endereço:</label>
                                <input type="text" name="address" class="form-control" v-model="fillEnterprise.address" />
                                <span v-if="formErrorsUpdate['address']" class="error text-danger">@{{ formErrorsUpdate['address'] }}</span>
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
        function formatTelephone(telephone){ 
            if(telephone.value.length == 0)
                telephone.value = '(' + telephone.value;
            if(telephone.value.length == 3)
                telephone.value = telephone.value + ') ';
            if(telephone.value.length == 10)
                telephone.value = telephone.value + '-';  
        }
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/vue.resource/0.9.3/vue-resource.min.js"></script>
    <script type="text/javascript" src="/js/admin-enterprises.js"></script>
@endsection
