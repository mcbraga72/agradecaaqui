@extends('enterprise.layout')

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
                                <th>Data/Hora</th>
                                <th>Status</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($enterpriseThanks as $enterpriseThank)
                            <tr>
                                <td>{{ $enterpriseThank->user->name }}</td>
                                <td>{{ $enterpriseThank->user->email }}</td>
                                <td>{{ $enterpriseThank->thanksDateTime->format('d/m/Y - H:i:s') }}</td>
                                <td>
                                    @if($enterpriseThank->replica && $enterpriseThank->rejoinder)
                                        <a href="{{ url('/empresa/agradecimento/' . $enterpriseThank->id . '/responder') }}"><i class="fa fa-check" style="color:#00A65A;" title="Agradecimento finalizado"></i></a>
                                    @elseif($enterpriseThank->replica && !$enterpriseThank->rejoinder)
                                        <a href="{{ url('/empresa/agradecimento/' . $enterpriseThank->id . '/responder') }}"><i class="fa fa-comments-o" style="color:#F39C12;" title="Aguardando tréplica do cliente"></i></a>
                                    @else        
                                        <a href="{{ url('/empresa/agradecimento/'. $enterpriseThank->id . '/responder') }}"><i class="fa fa-bell" style="color:red;" title="Aguardando resposta da empresa"></i></a>
                                    @endif                                        
                                </td>
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
