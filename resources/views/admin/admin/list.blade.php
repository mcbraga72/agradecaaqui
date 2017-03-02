@extends('admin.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <a href="{{ url('admin/administrador/criar') }}" class="btn btn-success btn-add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Criar administrador</a>
            <div class="panel panel-default">                
                <!-- Lista de usuários -->
                <div class="table-responsive">          
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th colspan="2"></th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                            <tr>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td><a href="/admin/administrador/{{ $admin->id }}/editar"><i class="fa fa-pencil-square-o"></i></a></td>
                                <td><a href="{{ route('admin.delete', $admin->id) }}"><i class="fa fa-trash-o"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>  
            </div>
        </div>
    </div>
</div>

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

<!-- Create Item Modal -->
<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Create Item</h4>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createItem">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" name="title" class="form-control" v-model="newItem.title" />
                        <span v-if="formErrors['title']" class="error text-danger">@{{ formErrors['title'] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="title">Description:</label>
                        <textarea name="description" class="form-control" v-model="newItem.description"></textarea>
                        <span v-if="formErrors['description']" class="error text-danger">@{{ formErrors['description'] }}</span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>        
            </div>
        </div>
    </div>
</div>

<!-- Edit Item Modal -->
<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Item</h4>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" name="title" class="form-control" v-model="fillItem.title" />
                        <span v-if="formErrorsUpdate['title']" class="error text-danger">@{{ formErrorsUpdate['title'] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="title">Description:</label>
                        <textarea name="description" class="form-control" v-model="fillItem.description"></textarea>
                        <span v-if="formErrorsUpdate['description']" class="error text-danger">@{{ formErrorsUpdate['description'] }}</span>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
