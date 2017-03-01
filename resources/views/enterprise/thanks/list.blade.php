@extends('enterprise.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">                
                <!-- Lista de usuários -->
                <div class="table-responsive">          
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>E-mail</th>
                                <th>Agradecimento</th>
                                <th></th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($enterpriseThanks as $enterpriseThank)
                            <tr>
                                <td>{{ $enterpriseThank->user->name }}</td>
                                <td>{{ $enterpriseThank->user->email }}</td>
                                <td>{{ $enterpriseThank->content }}</td>
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
