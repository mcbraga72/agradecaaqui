@extends('admin.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Perfil</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/administrador/' . $admin->id) }}">
                        {{ csrf_field() }}
                        <div class="label-register form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-6 col-md-offset-3">
                            <br><br>
                            <label for="name" class="col-md-6 control-label label-register">Nome</label>                        
                            <input id="name" type="text" class="form-control label-register" name="name" value="{{ $admin->name }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="label-register form-group{{ $errors->has('email') ? ' has-error' : '' }} col-md-6 col-md-offset-3">
                            <br><br>
                            <label for="email" class="col-md-6 control-label label-register">E-mail</label>                        
                            <input id="email" type="email" class="form-control label-register" name="email" value="{{ $admin->email }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="label-register form-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-6 col-md-offset-3">
                            <label for="password" class="col-md- control-label label-register">Senha</label>                        
                            <input id="password" type="password" class="form-control label-register" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="label-register form-group{{ $errors->has('password-confirm') ? ' has-error' : '' }} col-md-6 col-md-offset-3">
                            <label for="password-confirm" class="col-md-12 control-label label-register">Confirmar sneha</label>                        
                            <input id="password-confirm" type="password" class="form-control col-md-4 label-register" name="password-confirm" required>
                            @if ($errors->has('password-confirm'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password-confirm') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-success"><span><i class="fa fa-check"></i></span>Alterar</button>
                                <a href="{{ url('admin/administradores') }}" class="btn btn-danger"><span><i class="fa fa-close"></i></span>Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection