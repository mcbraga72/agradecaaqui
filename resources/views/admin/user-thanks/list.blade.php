@extends('admin.layout')
@section('content')
    <div class="container administrators" id="userThanks">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="item-title">Cadastro de Agradecimentos para Pessoas</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createUserThank"><i class="fa fa-plus fa-fw"></i>Cadastrar Agradecimento</button>
                    <input type="text" class="form-data search-box" placeholder=" Localizar" v-model="filterTerm" />
                </div>
            </div>
        </div>

        <!-- Users Thanks Listing -->
        <table class="table table-bordered table-striped">
            <tr>
                <th>Quem enviou</th>
                <th>Quem recebeu</th>
                <th>Data</th>
                <th>Agradecimento</th>
                <th colspan="2">Ação</th>
            </tr>
            <tr v-for="userThank in userThanks | filterBy filterTerm">
                <td>@{{ userThank.user.name }}</td>
                <td>@{{ userThank.receiptName }}</td>
                <td>@{{ userThank.thanksDateTime | formatDate }}</td>
                <td>@{{ userThank.content }}</td>
                <td>    
                  <button class="btn btn-primary" @click.prevent="editUserThank(userThank)"><i class="fa fa-pencil-square-o fa-fw"></i>Editar</button>
                  <button class="btn btn-danger" @click.prevent="deleteUserThank(userThank)"><i class="fa fa-trash-o fa-fw"></i>Remover</button>
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

        <!-- Create User Thank Modal -->
        <div class="modal fade" id="createUserThank" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-name" id="myModalLabel">Cadastro de agradecimentos</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createUserThank">
                            <div class="form-group">
                                <label for="receiptName">Destinatário:</label>
                                <input type="text" name="receiptName" class="form-control" v-model="newUserThank.receiptName" />
                                <span v-if="formErrors['receiptName']" class="error text-danger">@{{ formErrors['receiptName'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="receiptEmail">E-mail do destinatário:</label>
                                <input type="text" name="receiptEmail" class="form-control" v-model="newUserThank.receiptEmail" />
                                <span v-if="formErrors['receiptEmail']" class="error text-danger">@{{ formErrors['receiptEmail'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="content">Agradecimento:</label>
                                <textarea name="content" class="form-control" v-model="newUserThank.content" /></textarea>
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

        <!-- Edit User Thank Modal -->
        <div class="modal fade" id="editUserThank" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-name" id="myModalLabel">Editar agradecimento</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateUserThank(fillUserThank.id)">
                            <div class="form-group">
                                <label for="receiptName">Destinatário:</label>
                                <input type="text" name="receiptName" class="form-control" v-model="fillUserThank.receiptName" />
                                <span v-if="formErrorsUpdate['receiptName']" class="error text-danger">@{{ formErrorsUpdate['receiptName'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="receiptEmail">E-mail do destinatário:</label>
                                <input type="text" name="receiptEmail" class="form-control" v-model="fillUserThank.receiptEmail" />
                                <span v-if="formErrorsUpdate['receiptEmail']" class="error text-danger">@{{ formErrorsUpdate['receiptEmail'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="content">Agradecimento:</label>
                                <textarea name="content" class="form-control" v-model="fillUserThank.content" /></textarea>
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
    <script type="text/javascript" src="/js/admin-user-thanks.js"></script>
@endsection
