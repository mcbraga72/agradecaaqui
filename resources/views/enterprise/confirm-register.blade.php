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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url()->current() }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Senha</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control label-register" name="password" required>
                                @if ($errors->has('password'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('password') }}</strong>
		                            </span>
		                        @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password-confirm') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirme sua senha</label>
                            <div class="col-md-6">
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
