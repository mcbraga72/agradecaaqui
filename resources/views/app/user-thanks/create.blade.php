@extends('app.dashboard')

@section('content')
<script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>
    tinymce.init({ 
        selector:'textarea',
        plugins: 'emoticons',
        menubar: '',
        toolbar: 'undo redo | cut copy paste | styleselect | bold italic | link image | emoticons' 
    });
</script>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Cadastro de Agradecimentos - Pessoas</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('app/agradecimento-usuario') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nome</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-mail</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-4 control-label">Agradecimento</label>
                            <div class="col-md-6">
                                <textarea id="content" name="content" class="form-control" required>{{ old('content') }}</textarea>
                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success"><span><i class="fa fa-check"></i></span>Cadastrar</button>
                                <a href="{{ url('app/agradecimentos-usuarios') }}" class="btn btn-danger"><span><i class="fa fa-close"></i></span>Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
