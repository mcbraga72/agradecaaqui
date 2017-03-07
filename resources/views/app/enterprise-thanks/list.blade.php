@extends('app.template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 home">
            <img class="logo-login" src="{{asset('images/logo.png')}}"" />
            <h1 class="support">Comentários</h1>            
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/app/agradecimentos-empresas') }}">
            {{ csrf_field() }}
                <div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">
                    <br><br>
                    <div class="col-md-6">
                        <input id="search" type="text" class="form-control search" name="search" value="{{ old('search') }}" placeholder="Pesquisar por" required autofocus>
                        @if ($errors->has('search'))
                            <span class="help-block">
                                <strong>{{ $errors->first('search') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                        <button type="submit" class="btn pink-button">Pesquisar</button>                        
                    </div>
                </div>
            </form>
        </div>          
    </div>    
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            @if (!empty($success))
                <div class="alert alert-success">                
                    {{ $success }}                
                </div>    
            @endif
            <a href="{{ url('app/agradecimento-empresa/criar') }}" class="btn btn-success btn-add"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Cadastrar agradecimento para uma empresa</a>
            <div class="panel panel-default" style="margin-top: 20px !important">
                <!-- Lista de agradecimentos -->                
                <div class="table-responsive">          
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Empresa</th>
                            <th>Agradecimento</th>
                            <th colspan="2"></th>                                
                        </tr>                        
                        @foreach ($enterprisesThanks as $enterpriseThanks)
                        <tr>
                            <td>{{ $enterpriseThanks->enterprise->name }}</td>
                            <td>{{ $enterpriseThanks->content }}</td>
                            <td><a href=""><i class="fa fa-trash-o"></i></a></td>
                            <td><a href=""><i class="fa fa-pencil-square-o"></i></a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>  
            </div>
        </div>
    </div>
</div>

<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
    $('div.alert').delay(3000).slideUp(300);
</script>
@endsection
