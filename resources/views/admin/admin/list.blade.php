@extends('admin.dashboard')
@section('content')
    <div class="container administrators" id="administrators">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createAdmin"><i class="fa fa-plus fa-fw"></i>Cadastrar Administrador</button>
                </div>
            </div>
        </div>

        <!-- Admin Listing -->
        <table class="table table-bordered table-striped">
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th colspan="2">Ação</th>
            </tr>
            <tr v-for="admin in admins">
                <td>@{{ admin.name }}</td>
                <td>@{{ admin.email }}</td>
                <td>    
                  <button class="btn btn-primary" @click.prevent="editAdmin(admin)"><i class="fa fa-pencil-square-o fa-fw"></i>Editar</button>
                  <button class="btn btn-danger" @click.prevent="deleteAdmin(admin)"><i class="fa fa-trash-o fa-fw"></i>Remover</button>
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

        <!-- Create Admin Modal -->
        <div class="modal fade" id="createAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-name" id="myModalLabel">Cadastro de administradores</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createAdmin">
                            <div class="form-group">
                                <label for="name">Nome:</label>
                                <input type="text" name="name" class="form-control" v-model="newAdmin.name" />
                                <span v-if="formErrors['name']" class="error text-danger">@{{ formErrors['name'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="name">E-mail:</label>
                                <input type="email" name="email" class="form-control" v-model="newAdmin.email" />
                                <span v-if="formErrors['email']" class="error text-danger">@{{ formErrors['email'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="password">Senha:</label>
                                <input type="password" name="password" class="form-control" v-model="newAdmin.password" />
                                <span v-if="formErrors['password']" class="error text-danger">@{{ formErrors['password'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">Confirmar Senha:</label>
                                <input type="password" name="password-confirm" class="form-control" v-model="newAdmin.password" />
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

        <!-- Edit Admin Modal -->
        <div class="modal fade" id="editAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-name" id="myModalLabel">Editar dados do administrador</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateAdmin(fillAdmin.id)">
                            <div class="form-group">
                                <label for="name">Nome:</label>
                                <input type="text" name="name" class="form-control" v-model="fillAdmin.name" />
                                <span v-if="formErrorsUpdate['name']" class="error text-danger">@{{ formErrorsUpdate['name'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="name">E-mail:</label>
                                <input type="email" name="email" class="form-control" v-model="fillAdmin.email" />
                                <span v-if="formErrorsUpdate['email']" class="error text-danger">@{{ formErrorsUpdate['email'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="password">Senha:</label>
                                <input type="password" name="password" class="form-control" v-model="fillAdmin.password" />
                                <span v-if="formErrorsUpdate['password']" class="error text-danger">@{{ formErrorsUpdate['password'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">Confirmar Senha:</label>
                                <input type="password" name="password-confirm" class="form-control" v-model="fillAdmin.password" />
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
    <script type="text/javascript" src="/js/admin-administrators.js"></script>
@endsection
