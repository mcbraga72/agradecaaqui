@extends('enterprise.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">                
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/empresa/agradecimento/' . $enterpriseThanks->id) }}">
                        {{ csrf_field() }}
                        <p>Agradecimento</p>
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="client" class="col-md-4 control-label">Cliente</label>
                            <div class="col-md-6">
                                <input readonly type="text" id="client" name="client" class="form-control" value="{{ $enterpriseThanks->user->name }}">
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-4 control-label">Agradecimento</label>
                            <div class="col-md-6">
                                <textarea readonly id="content" name="content" class="form-control" required>{{ $enterpriseThanks->content }}</textarea>
                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('replica') ? ' has-error' : '' }}">
                            <label for="replica" class="col-md-4 control-label">Resposta da empresa</label>
                            <div class="col-md-6">
                                <textarea id="replica" name="replica" class="form-control" required>{{ $enterpriseThanks->replica }}</textarea>
                                @if ($errors->has('replica'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('replica') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @if($enterpriseThanks->rejoinder)
                        <div class="form-group{{ $errors->has('rejoinder') ? ' has-error' : '' }}">
                            <label for="rejoinder" class="col-md-4 control-label">Réplica do cliente</label>
                            <div class="col-md-6">
                                <textarea readonly id="rejoinder" name="rejoinder" class="form-control" required>{{ $enterpriseThanks->rejoinder }}</textarea>
                                @if ($errors->has('rejoinder'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rejoinder') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success"><span><i class="fa fa-check"></i></span>Enviar</button>
                                <a href="{{ url('/empresa/agradecimentos') }}" class="btn btn-danger"><span><i class="fa fa-close"></i></span>Cancelar</a>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
