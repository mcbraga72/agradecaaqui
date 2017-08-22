@extends('enterprise.layout')

@section('content')
<div class="container-fluid">
    <div class="row">    
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h4 style="margin-top: 2%;">Agradecimentos</h4><br>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <a href="/empresa/cadastro/agradecimentos/exportar" class="btn btn-primary"><i class="fa fa-file-excel-o fa-fw"></i>Exportar cadastro</a>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Cliente</th>
                    <th>E-mail</th>
                    <th>Data/Hora</th>
                    <th>Status</th>
                </tr>
                <tr v-for="enterpriseThank in enterpriseThanks">
                    <td>@{{ enterpriseThank.user.name + ' ' + enterpriseThank.user.surName }}</td>
                    <td>@{{ enterpriseThank.user.email }}</td>
                    <td>@{{ enterpriseThank.thanksDateTime | formatDate }}</td>
                    <td v-if="enterpriseThank.replica != null && enterpriseThank.rejoinder != null"><a href="#" @click.prevent="replyThanks(enterpriseThank)"><i class="fa fa-check" style="color:#00A65A;" title="Agradecimento finalizado"></i></a></td>
                    <td v-if="enterpriseThank.replica != null && enterpriseThank.rejoinder == null"><a href="#" @click.prevent="replyThanks(enterpriseThank)"><i class="fa fa-comments-o" style="color:#F39C12;" title="Aguardando tréplica do cliente"></i></a></td>
                    <td v-if="enterpriseThank.replica == null"><a href="#" @click.prevent="replyThanks(enterpriseThank)"><i class="fa fa-bell" style="color:red;" title="Aguardando resposta da empresa"></i></a></td>
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
            
            <!-- Reply Thanks Modal -->
            <div class="modal fade" id="replyThanks" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-name" id="myModalLabel">Editar Agradecimento</h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateThanks(enterpriseThanks)">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="client" class="control-label">Cliente</label>
                                    <input readonly type="text" id="client" name="client" class="form-control" v-model="fillEnterpriseThanks.client">
                                    <span v-if="formErrorsThanks['content']" class="error text-danger">@{{ formErrorsThanks['content'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="content" class="control-label">Agradecimento</label>                        
                                    <textarea readonly id="content" name="content" class="form-control" v-model="fillEnterpriseThanks.content" ></textarea>
                                    <span v-if="formErrorsThanks['content']" class="error text-danger">@{{ formErrorsThanks['content'] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="replica" class="control-label">Resposta da empresa</label>                        
                                    <textarea id="replica" name="replica" class="form-control" required v-model="fillEnterpriseThanks.replica" ></textarea>
                                    <span v-if="formErrorsThanks['replica']" class="error text-danger">@{{ formErrorsThanks['replica'] }}</span>                        
                                </div>                    
                                <div class="form-group" v-if="fillEnterpriseThanks.rejoinder != null">
                                    <label for="rejoinder" class="control-label">Réplica do cliente</label>
                                    <textarea readonly id="rejoinder" name="rejoinder" class="form-control" v-model="fillEnterpriseThanks.rejoinder" ></textarea>
                                    <span v-if="formErrorsThanks['rejoinder']" class="error text-danger">@{{ formErrorsThanks['rejoinder'] }}</span>
                                </div>                    
                                <div class="form-group">                        
                                    <button type="submit" class="btn btn-success"><span><i class="fa fa-check"></i></span>Enviar</button>                        
                                </div>
                            </form>                
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>


<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/vue.resource/0.9.3/vue-resource.min.js"></script>
<script type="text/javascript" src="/js/app-enterprises.js"></script>
@endsection
