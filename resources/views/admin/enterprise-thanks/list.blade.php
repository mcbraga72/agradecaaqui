@extends('admin.dashboard')
@section('content')
    <div class="container administrators" id="enterpriseThanks">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createEnterpriseThank"><i class="fa fa-plus fa-fw"></i>Cadastrar Agradecimento</button>
                </div>
            </div>
        </div>

        <!-- Enterprises Thanks Listing -->
        <table class="table table-bordered table-striped">
            <tr>
                <th>Usuário</th>
                <th>Empresa</th>
                <th>Agradecimento</th>
                <th colspan="2">Ação</th>
            </tr>
            <tr v-for="enterpriseThank in enterpriseThanks">
                <td>@{{ enterpriseThank.user.name }}</td>
                <td>@{{ enterpriseThank.enterprise.name }}</td>
                <td>@{{ enterpriseThank.content }}</td>
                <td>    
                  <button class="btn btn-primary" @click.prevent="editEnterpriseThank(enterpriseThank)"><i class="fa fa-pencil-square-o fa-fw"></i>Editar</button>
                  <button class="btn btn-danger" @click.prevent="deleteEnterpriseThank(enterpriseThank)"><i class="fa fa-trash-o fa-fw"></i>Remover</button>
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

        <!-- Create Enterprise Thank Modal -->
        <div class="modal fade" id="createEnterpriseThank" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-name" id="myModalLabel">Cadastro de agradecimentos</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createEnterpriseThank">
                            <div class="form-group">
                                <label for="enterprise_id">Empresa:</label>
                                <select name="enterprise_id" class="form-control" v-model="newEnterpriseThank.enterprise_id" />
                                    <option value="">Selecione a empresa</option>
                                    <option value="@{{ enterprise.id }}" v-for="enterprise in enterprises">@{{ enterprise.name }}</option>
                                </select>
                                <span v-if="formErrors['enterprise_id']" class="error text-danger">@{{ formErrors['enterprise_id'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="content">Agradecimento:</label>
                                <textarea name="content" class="form-control" v-model="newEnterpriseThank.content" /></textarea>
                                <span v-if="formErrors['content']" class="error text-danger">@{{ formErrors['content'] }}</span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Enterprise Thank Modal -->
        <div class="modal fade" id="editEnterpriseThank" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-name" id="myModalLabel">Editar agradecimento</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateEnterpriseThank(fillEnterpriseThank.id)">
                            <div class="form-group">
                                <label for="name">Empresa:</label>
                                <select name="name" class="form-control" v-model="fillEnterpriseThank.enterprise_id" />
                                    <option value="">Selecione a empresa</option>
                                    <option value="@{{ enterprise.id }}" v-for="enterprise in enterprises">@{{ enterprise.name }}</option>
                                </select>
                                <span v-if="formErrorsUpdate['enterprise_id']" class="error text-danger">@{{ formErrorsUpdate['enterprise_id'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="content">Agradecimento:</label>
                                <textarea name="content" class="form-control" v-model="fillEnterpriseThank.content" /></textarea>
                                <span v-if="formErrorsUpdate['content']" class="error text-danger">@{{ formErrorsUpdate['content'] }}</span>
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
    <script type="text/javascript" src="/js/admin-enterprise-thanks.js"></script>
@endsection
