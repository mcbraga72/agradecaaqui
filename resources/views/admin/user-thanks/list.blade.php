@extends('admin.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <a href="{{ url('admin/agradecimento-usuario/criar') }}" class="btn btn-success btn-add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Cadastrar agradecimento - Usuário</a>
            <div class="panel panel-default">                
                <!-- Lista de usuários -->
                <div class="table-responsive">          
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Usuário</th>
                                <th>Empresa</th>
                                <th>Agradecimento</th>
                                <th colspan="2"></th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usersThanks as $userThanks)
                            <tr>
                                <td>{{ $userThanks->user()->name }}</td>
                                <td>{{ $userThanks->enterprise()->name }}</td>
                                <td>{{ $userThanks->content }}</td>
                                <td><a href=""><i class="fa fa-trash-o"></i></a></td>
                                <td><a href=""><i class="fa fa-pencil-square-o"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection
