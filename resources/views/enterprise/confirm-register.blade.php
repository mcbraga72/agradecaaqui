@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Ativação de cadastro</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/empresa/confirmar-cadastro/'{{ $confirmationCode }}) }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="label-register form-group{{ $errors->has('password') ? ' has-error' : '' }}">
		                    <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
		                        <label for="password" class="col-md-4 control-label label-register">Senha</label>                        
		                        <input id="password" type="password" class="form-control label-register" name="password" required>
		                        @if ($errors->has('password'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('password') }}</strong>
		                            </span>
		                        @endif
		                    </div>    
		                </div>
		                <div class="label-register form-group{{ $errors->has('password-confirm') ? ' has-error' : '' }}">
		                    <br><br>
		                    <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
		                        <label for="password-confirm" class="col-md-12 control-label label-register">Confirme sua senha</label>                        
		                        <input id="password-confirm" type="password" class="form-control label-register" name="password-confirm" required>
		                        @if ($errors->has('password-confirm'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('password-confirm') }}</strong>
		                            </span>
		                        @endif
		                    </div>    
		                </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Definir senha
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
