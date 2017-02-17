@extends('admin.dashboard')

@section('content')
<script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    tinymce.init({ 
        selector:'textarea',
        plugins: 'emoticons',
        menubar: '',
        toolbar: 'undo redo | cut copy paste | styleselect | bold italic | link image | emoticons' 
    });
    
    var path = "{{ route('autocomplete') }}";
    
    $('input.typeahead').typeahead({
        source: function (query, process) {
            return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });
    
</script>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Cadastro de Agradecimentos - Empresas</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/agradecimento-empresa') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="enterprise" class="col-md-4 control-label">Empresa</label>
                            <div class="col-md-6">
                                <!--<input id="enterprise" type="text" class="form-control typeahead" name="enterprise" value="{{ old('enterprise') }}" required autofocus>-->
                                <select class="selectpicker" id="enterprise_id">
                                    <option value="0">Selecione a empresa</option>
                                    @foreach ($enterprises as $enterprise) 
                                    <option value="{{ $enterprise->id }}">{{ $enterprise->name }}</option>           
                                    @endforeach                         
                                </select>
                                @if ($errors->has('enterprise'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('enterprise') }}</strong>
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
                                <a href="{{ url('admin/agradecimentos-empresas') }}" class="btn btn-danger"><span><i class="fa fa-close"></i></span>Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
