@extends('site.template')

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
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0 nopadding">
                <img src="{{ URL::to('/') }}/images/banner.png" width="100%" />
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
                <img class="logo-login" src="images/logo.png" />
                <h1 class="support">O que você quer </h1><span class="pink">agradecer</span><h1 class="support"> hoje?</h1>
			</div>
			<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/agradecimento-empresa') }}">
                {{ csrf_field() }}
	                <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
		                <button type="button" class="home"><img src="images/pessoas.png" /></button>
		                <button type="button" class="home"><img src="images/empresas.png" /></button>
		            </div>
	                <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
		                <br><br>
		                <label for="nome" class="col-md-4 control-label">Para</label>
		                <div class="col-md-6">
		                    <input id="nome" type="nome" class="form-control" name="nome" value="{{ old('nome') }}" required autofocus>
		                    @if ($errors->has('nome'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('nome') }}</strong>
		                        </span>
		                    @endif
		                </div>
		            </div>
		            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	                    <br><br>
	                    <label for="email" class="col-md-4 control-label">E-Mail</label>
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
	                        <button type="submit" class="btn btn-success"><span><i class="fa fa-check"></i></span>Enviar</button>                        
	                    </div>
	                </div>
	            </form>
			</div>
			<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
                <img class="logo-login" src="images/logo.png" />
                <h1 class="support">Comentários</h1>			
				<form class="form-horizontal" role="form" method="POST" action="{{ url('busca') }}">
	            {{ csrf_field() }}
					<div class="form-group{{ $errors->has('busca') ? ' has-error' : '' }}">
		                <br><br>
		                <div class="col-md-6">
		                    <input id="busca" type="busca" class="form-control" name="busca" value="{{ old('busca') }}" placeholder="Pesquisar por" required autofocus>
		                    @if ($errors->has('busca'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('busca') }}</strong>
		                        </span>
		                    @endif
		                </div>
		            </div>
		            <div class="form-group">
		                <div class="col-md-6 col-md-offset-4">
		                    <button type="submit" class="btn btn-success"><span><i class="fa fa-check"></i></span>Pesquisar</button>	                    
		                </div>
		            </div>
		        </form>
	        </div>
	        <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
				@foreach($agradecimentos as $agradecimento)
					<div>
					</div>
				@endforeach
	        </div>
		</div>        
    </div>

@endsection