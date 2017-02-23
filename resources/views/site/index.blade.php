@extends('site.template')

@section('content')
	<script src="http://cloud.tinymce.com/stable/tinymce.min.js?apiKey=0zfrot4cp11wye4w5un16jq685zt2zsd0pqlbmpgobuylmno"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
	<script type="text/javascript">
	    tinymce.init({ 
	        selector:'textarea',
	        plugins: 'emoticons',
	        menubar: '',
	        toolbar: 'undo redo | cut copy paste | styleselect | bold italic | link image | emoticons' 
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
                {{--<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />--}}                
                <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
	                <button id="peopleButton" type="button" class="home"><img src="images/pessoas.png" /></button>
	                <button id="enterprisesButton" type="button" class="home"><img src="images/empresas.png" /></button>
	            </div>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('entrar') }}">                
                	{{ csrf_field() }}
	                <div id="enterpriseThanks">		                
			            <div class="form-group{{ $errors->has('enterprise_id') ? ' has-error' : '' }}">
			                <br><br>
			                <label for="enterprise_id" class="col-md-4 control-label form-home">EMPRESA</label>
			                <div class="col-md-6">
			                    {{--<input id="enterprise_id" type="text" class="form-control" name="enterprise_id" value="{{ old('enterprise_id') }}" required autofocus placeholder="Empresa">--}}
			                    <select id="enterprise_id" name="enterprise_id" class="selectpicker form-control">
                                    <option value="0">Selecione a empresa</option>
                                    @foreach ($data['enterprises'] as $enterprise) 
                                    <option value="{{ $enterprise->id }}">{{ $enterprise->name }}</option>           
                                    @endforeach                         
                                </select>
			                    @if ($errors->has('enterprise_id'))
			                        <span class="help-block">
			                            <strong>{{ $errors->first('enterprise_id') }}</strong>
			                        </span>
			                    @endif
			                </div>
			            </div>
			            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
		                    <img src="images/heart.png" /><label for="content" class="col-md-4 control-label form-home">AGRADEÇA AQUI</label>
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
		                    	<button type="button" class="btn social-network facebook-button"><i class="fa fa-2x fa-facebook" aria-hidden="true"></i></button>
		                    	<button type="button" class="btn social-network twitter-button"><i class="fa fa-2x fa-twitter" aria-hidden="true"></i></button>
		                    	<button type="button" class="btn social-network google-button"><i class="fa fa-2x fa-google-plus" aria-hidden="true"></i></button>
		                    	<button type="button" class="btn social-network whatsapp-button"><i class="fa fa-2x fa-whatsapp" aria-hidden="true"></i></button>
		                        <input type="submit" class="btn pink-button" value="ENVIAR">
		                    </div>
		                </div>
	                </div>
	            </form>
				<form class="form-horizontal" role="form" method="POST" action="{{ url('/app/agradecimento-usuario') }}">                		            
					<div id="userThanks">
		                <div class="form-group{{ $errors->has('userName') ? ' has-error' : '' }}">
			                <br><br>
			                <label for="userName" class="col-md-4 control-label form-home">PARA</label>
			                <div class="col-md-6">
			                    <input id="userName" type="text" class="form-control" name="userName" value="{{ old('userName') }}" required autofocus placeholder="Nome">
			                    @if ($errors->has('userName'))
			                        <span class="help-block">
			                            <strong>{{ $errors->first('userName') }}</strong>
			                        </span>
			                    @endif
			                </div>
			            </div>
			            <div class="form-group{{ $errors->has('userEmail') ? ' has-error' : '' }}">
		                    <br><br>
		                    <label for="userEmail" class="col-md-4 control-label form-home">E-MAIL</label>
		                    <div class="col-md-6">
		                        <input id="userEmail" type="email" class="form-control" name="userEmail" value="{{ old('userEmail') }}" required autofocus placeholder="E-mail do destinatário">
		                        @if ($errors->has('userEmail'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('userEmail') }}</strong>
		                            </span>
		                        @endif
		                    </div>
		                </div>
		                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
		                    <img src="images/heart.png" /><label for="content" class="col-md-4 control-label form-home">AGRADEÇA AQUI</label>
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
	        	@forelse($data['enterpriseThanks'] as $enterpriseThank)
	        		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thanks-title">Lorem Ipsum</p>
	                    <img class="heart" src="images/heart.png" />
	                    <p class="thaks-content">{{ strip_tags($enterpriseThank->content) }}</p>
	                    <img class="user-photo"src="images/cliente1.png" alt="Agradecimento" title="Agradecimento" />
	                    <span class="user-name">Camila Veiga</span>
	                </div>    				
				@empty
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

    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(document).ready(function() {
    		$('#enterpriseThanks').show();
	    	$('#userThanks').hide();
	    	$('#enterprisesButton').addClass('button-selected');

	    	$("#enterprise_id").autocomplete('/app/busca/empresa', {
                selectFirst: true
            });
		});

	    $('#peopleButton').click(function(){
	    	$('#enterpriseThanks').hide();
	    	$('#userThanks').show();
	    	$('#peopleButton').addClass('button-selected');
	    	$('#enterprisesButton').removeClass('button-selected');
	    });
	    $('#enterprisesButton').click(function() {
	    	$('#enterpriseThanks').show();
	    	$('#userThanks').hide();
	    	$('#enterprisesButton').addClass('button-selected');
	    	$('#peopleButton').removeClass('button-selected');
	    });
	</script>

@endsection