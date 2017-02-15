@extends('admin.dashboard')

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
                <div class="panel-heading">Cadastro de Agradecimentos - Usuários</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/agradecimento-usuario') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="user" class="col-md-4 control-label">Usuário</label>
                            <div class="col-md-6">
                                <input id="user" type="text" class="form-control" name="user" value="{{ old('user') }}" required autofocus>
                                @if ($errors->has('user'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user') }}</strong>
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
                                <a href="{{ url('admin/agradecimentos-usuarios') }}" class="btn btn-danger"><span><i class="fa fa-close"></i></span>Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
