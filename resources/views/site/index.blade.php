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
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 home">
                <img class="logo" src="images/logo.png" />
                <h1 class="thanks-text">O que você quer </h1><span class="pink"> agradecer </span><h1 class="thanks-text"> hoje?</h1>			
                <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/agradecimento-empresa') }}">
                {{ csrf_field() }}
	                <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
		                <button type="button" class="home"><img src="images/pessoas.png" /></button>
		                <button type="button" class="home"><img src="images/empresas.png" /></button>
		            </div>
	                <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
		                <br><br>
		                <label for="nome" class="col-md-4 control-label">PARA</label>
		                <div class="col-md-6">
		                    <input id="nome" type="nome" class="form-control" name="nome" value="{{ old('nome') }}" required autofocus placeholder="Nome">
		                    @if ($errors->has('nome'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('nome') }}</strong>
		                        </span>
		                    @endif
		                </div>
		            </div>
		            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	                    <br><br>
	                    <label for="email" class="col-md-4 control-label">E-MAIL</label>
	                    <div class="col-md-6">
	                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="E-mail do destinatário">
	                        @if ($errors->has('email'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('email') }}</strong>
	                            </span>
	                        @endif
	                    </div>
	                </div>
	                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
	                    <img src="images/heart.png" /><label for="content" class="col-md-4 control-label">AGRADEÇA AQUI</label>
	                    <div class="col-md-6">
	                        <textarea id="content" name="content" class="form-control" required placeholder="Seu agradecimento aqui :)">{{ old('content') }}</textarea>
	                        @if ($errors->has('content'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('content') }}</strong>
	                            </span>
	                        @endif
	                    </div>
	                </div>
	                <div class="form-group">
	                    <div class="col-md-6 col-md-offset-4">
	                    	<button type="submit" class="btn social-network facebook-button"><i class="fa fa-2x fa-facebook" aria-hidden="true"></i></button>
	                    	<button type="submit" class="btn social-network twitter-button"><i class="fa fa-2x fa-twitter" aria-hidden="true"></i></button>
	                    	<button type="submit" class="btn social-network google-button"><i class="fa fa-2x fa-google-plus" aria-hidden="true"></i></button>
	                    	<button type="submit" class="btn social-network whatsapp-button"><i class="fa fa-2x fa-whatsapp" aria-hidden="true"></i></button>
	                        <button type="submit" class="btn pink-button">ENVIAR</button>
	                    </div>
	                </div>
	            </form>
	            <br><br>	
                <img class="logo-login" src="images/logo.png" />
                <h1 class="support">Comentários</h1>			
				<form class="form-horizontal" role="form" method="POST" action="{{ url('busca') }}">
	            {{ csrf_field() }}
					<div class="form-group{{ $errors->has('busca') ? ' has-error' : '' }}">
		                <br><br>
		                <div class="col-md-6">
		                    <input id="busca" type="busca" class="form-control search" name="busca" value="{{ old('busca') }}" placeholder="Pesquisar por" required autofocus>
		                    @if ($errors->has('busca'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('busca') }}</strong>
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
			<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
	        	@forelse($enterpriseThanks as $enterpriseThank)
    				<h2>{{ $enterpriseThank->content }}</h2>
				@empty
    				<!--<h2>Não existe nenhum agradecimento cadastrado em nossa base de dados!</h2>-->    				
					<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thanks-title">Lorem Ipsum</p>
	                    <img class="heart" src="images/heart.png" />
	                    <p class="thaks-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	                    <img class="user-photo"src="images/cliente1.png" alt="Agradecimento" title="Agradecimento" />
	                    <span class="user-name">Camila Veiga</span>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thanks-title">Lorem Ipsum</p>
	                    <img class="heart" src="images/heart.png" />
	                    <p class="thaks-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	                    <img class="user-photo" src="images/cliente2.png" alt="Agradecimento" title="Agradecimento" />
	                    <span class="user-name">Gerson Freitas</span>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thanks-title">Lorem Ipsum</p>
	                    <img class="heart" src="images/heart.png" />
	                    <p class="thaks-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	                    <img class="user-photo" src="images/cliente3.png" alt="Agradecimento" title="Agradecimento" />
	                    <span class="user-name">Tatiana Barros</span>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thanks-title">Lorem Ipsum</p>
	                    <img class="heart" src="images/heart.png" />
	                    <p class="thaks-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	                    <img class="user-photo" src="images/cliente1.png" alt="Agradecimento" title="Agradecimento" />
	                    <span class="user-name">Camila Veiga</span>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thanks-title">Lorem Ipsum</p>
	                    <img class="heart" src="images/heart.png" />
	                    <p class="thaks-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	                    <img class="user-photo" src="images/cliente2.png" alt="Agradecimento" title="Agradecimento" />
	                    <span class="user-name">Gerson Freitas</span>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thanks-title">Lorem Ipsum</p>
	                    <img class="heart" src="images/heart.png" />
	                    <p class="thaks-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	                    <img class="user-photo" src="images/cliente3.png" alt="Agradecimento" title="Agradecimento" />
	                    <span class="user-name">Tatiana Barros</span>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thanks-title">Lorem Ipsum</p>
	                    <img class="heart" src="images/heart.png" />
	                    <p class="thaks-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	                    <img class="user-photo" src="images/cliente1.png" alt="Agradecimento" title="Agradecimento" />
	                    <span class="user-name">Camila Veiga</span>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thanks-title">Lorem Ipsum</p>
	                    <img class="heart" src="images/heart.png" />	                    
	                    <p class="thaks-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	                    <img class="user-photo" src="images/cliente2.png" alt="Agradecimento" title="Agradecimento" />
	                    <span class="user-name">Gerson Freitas</span>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thanks-title">Lorem Ipsum</p>
	                    <img class="heart" src="images/heart.png" />
	                    <p class="thaks-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	                    <img class="user-photo" src="images/cliente3.png" alt="Agradecimento" title="Agradecimento" />
	                    <span class="user-name">Tatiana Barros</span>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 show-more">
						<img class="plus" src="images/plus.png" alt="Mostrar mais" title="Mostrar mais" />
	                </div>
				@endforelse				
	        </div>    
	    </div>
    </div>

@endsection