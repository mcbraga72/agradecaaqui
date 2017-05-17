@extends('app.template')

@section('content')
	<script src="http://cloud.tinymce.com/stable/tinymce.min.js?apiKey=0zfrot4cp11wye4w5un16jq685zt2zsd0pqlbmpgobuylmno"></script>
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
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 home">
                <img class="logo" src="images/logo.png" />
                <h1 class="thanks-text">O que você quer </h1><span class="pink"> agradecer </span><h1 class="thanks-text"> hoje?</h1>			
                <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
	                <button id="peopleButton" type="button" class="home"><img src="images/pessoas.png" /></button>
	                <button id="enterprisesButton" type="button" class="home"><img src="images/empresas.png" /></button>
	            </div>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/app/agradecimento-empresa') }}" novalidate>                
                	{{ csrf_field() }}
	                <div id="enterpriseThanks">		                
			            <div class="form-home form-group{{ $errors->has('enterprise_id') ? ' has-error' : '' }}">			                
			                <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
			                	<label for="enterprise_id" class="col-md-4 control-label">EMPRESA</label>			                    
			                    <select id="enterprise_id" name="enterprise_id" class="selectpicker form-control chosen-select">
                                    <option value="0">Selecione a empresa</option>
                                    @foreach ($data['enterprises'] as $enterprise)
                                    	@if (Session::has('enterprise_id') && $enterprise->id == Session::get('enterprise_id'))
                                    		<option value="{{ $enterprise->id }}" selected>{{ $enterprise->name }}</option>
                                    	@else
											<option value="{{ $enterprise->id }}">{{ $enterprise->name }}</option>
                                    	@endif
                                    @endforeach                         
                                </select>
			                    @if ($errors->has('enterprise_id'))
			                        <span class="help-block">
			                            <strong>{{ $errors->first('enterprise_id') }}</strong>
			                        </span>
			                    @endif
			                </div>
			            </div>
			            <div class="form-home form-group{{ $errors->has('content') ? ' has-error' : '' }}">
		                    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
		                    	<img class="heart-form" src="images/heart.png" /><label for="content" class="col-md-4 control-label form-home">AGRADEÇA AQUI</label>
		                        <textarea id="content" name="content" class="form-control" required placeholder="Seu agradecimento aqui :)">@if(Session::has('content')) {{ Session::get('content') }} @endif</textarea>
		                        @if ($errors->has('content'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('content') }}</strong>
		                            </span>
		                        @endif
		                    </div>
		                </div>
		                <div class="form-group">
		                    <div class="col-md-6 col-md-offset-4">
		                    	<input type="submit" class="btn pink-button" value="ENVIAR">
		                    </div>
		                </div>
	                </div>
	            </form>
				<form class="form-horizontal" role="form" method="POST" action="{{ url('/app/agradecimento-usuario') }}" novalidate>
					{{ csrf_field() }}
					<div id="userThanks">
		                <div class="form-home form-group{{ $errors->has('receiptName') ? ' has-error' : '' }}">
			                <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
			                	<label for="receiptName" class="col-md-4 control-label form-home">PARA</label>
			                    <input id="receiptName" type="text" class="form-control" name="receiptName" @if(Session::has('receiptName')) value="{{ Session::get('receiptName') }}" @else value="{{ old('receiptName') }}" @endif required autofocus placeholder="Nome">
			                    @if ($errors->has('receiptName'))
			                        <span class="help-block">
			                            <strong>{{ $errors->first('receiptName') }}</strong>
			                        </span>
			                    @endif
			                </div>
			            </div>
			            <div class="form-home form-group{{ $errors->has('receiptEmail') ? ' has-error' : '' }}">
		                    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
		                    	<label for="receiptEmail" class="col-md-4 control-label form-home">E-MAIL</label>
		                        <input id="receiptEmail" type="email" class="form-control" name="receiptEmail" @if(Session::has('receiptEmail')) value="{{ Session::get('receiptEmail') }}" @else value="{{ old('receiptEmail') }}" @endif required autofocus placeholder="E-mail do destinatário">
		                        @if ($errors->has('receiptEmail'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('receiptEmail') }}</strong>
		                            </span>
		                        @endif
		                    </div>
		                </div>
		                <div class="form-home form-group{{ $errors->has('content') ? ' has-error' : '' }}">
		                    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
		                    	<img class="heart-form" src="images/heart.png" /><label for="content" class="col-md-4 control-label form-home">AGRADEÇA AQUI</label>
		                        <textarea id="content" name="content" class="form-control" required placeholder="Seu agradecimento aqui :)">@if(Session::has('content')) {{ Session::get('content') }} @endif</textarea>
		                        @if ($errors->has('content'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('content') }}</strong>
		                            </span>
		                        @endif
		                    </div>
		                </div>
		                <div class="form-group">
		                    <div class="col-md-6 col-md-offset-4">
		                    	<input type="submit" class="btn pink-button" value="ENVIAR">
		                    </div>
		                </div>
	                </div>
	            </form>
	            <br><br>	
                <img class="logo-login" src="images/logo.png" />
                <h1 class="support">Comentários</h1>			
				<form class="form-horizontal" role="form" method="POST" action="{{ url('/app/agradecimentos/busca') }}">
	            {{ csrf_field() }}
					<div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">
		                <br><br>
		                <div class="col-md-6">
		                    <input type="text" class="form-control search" id="search" name="search" placeholder="Pesquisar por" required autofocus>
		                    @if ($errors->has('search'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('search') }}</strong>
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
	        	@forelse($data['enterprisesThanks'] as $enterprisesThank)
	        		<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-1 col-lg-3 col-xl-2 col-xl-offset-1 thanks-box">
	                    <p class="thanks-title">{{ $enterprisesThank->name }}</p>
	                    <a href="{{ route('enterprise-thanks.show', $enterprisesThank->hash) }}"><img class="heart" src="{{ asset('images/heart.png') }}" /></a>
	                    <p class="thaks-content">{{ strip_tags($enterprisesThank->content) }}</p>
	                    <img class="user-photo" src="{{ asset($enterprisesThank->logo) }}" alt="Agradecimento" title="Agradecimento" />	                    
	                </div>    				
				@empty
    				<div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 col-xl-6 col-xl-offset-3 thanks-box">
	                    <img class="heart" src="images/heart.png" />
	                    <p class="thaks-content">Você ainda não fez nenhum agradecimento em nossa plataforma.</p>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 show-more">
						<img class="plus" src="images/plus.png" alt="Mostrar mais" title="Mostrar mais" />
	                </div>
				@endforelse
				@forelse($data['usersThanks'] as $usersThank)
	        		<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-1 col-lg-3 col-xl-2 col-xl-offset-1 thanks-box">
	                    <p class="thanks-title">{{ $usersThank->receiptName }}</p>
	                    <a href="{{ route('user-thanks.show', $usersThank->hash) }}"><img class="heart" src="{{ asset('images/heart.png') }}" /></a>
	                    <p class="thaks-content">{{ strip_tags($usersThank->content) }}</p>
	                    <img class="user-photo" src="{{ asset('images/people.png') }}" alt="Agradecimento" title="Agradecimento" />
	                </div>    				
				@empty
    				<div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 col-xl-6 col-xl-offset-3 thanks-box">
	                    <img class="heart" src="images/heart.png" />
	                    <p class="thaks-content">Você ainda não fez nenhum agradecimento em nossa plataforma.</p>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 show-more">
						<img class="plus" src="images/plus.png" alt="Mostrar mais" title="Mostrar mais" />
	                </div>
				@endforelse
	        </div>    
	    </div>
    </div>

	<!-- Complete Register Alert Modal -->
	<div class="modal fade" id="completeRegisterAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-name about" id="myModalLabel">Prezado cliente</h4>
                </div>
                <div class="modal-body">
                	<img class="logo" src="images/logo.png" />
                	<h4 class="modal-name complete-register" id="myModalLabel">Preencha seu cadastro completo e concorra a prêmios!</h4><br>
                </div>	
                <div class="modal-footer">	
                	<button type="button" id="openCompleteRegister" class="btn btn-success" data-dismiss="modal" aria-label="Close">Quero preencher<i class="fa fa-check fa-fw" aria-hidden="true"></i></button>
                	<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Agora não<i class="fa fa-times fa-fw" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/vue.resource/0.9.3/vue-resource.min.js"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript" src="/js/vendor/chosen/chosen.jquery.js"></script>
    <script type="text/javascript" src="/js/app-users.js"></script>

	<script type="text/javascript">
		@foreach($data['user'] as $user)
			@if($user->registerType == 'Padrão')			
				$('#completeRegisterAlert').modal('show');
			@endif
		@endforeach

		$('.chosen-select').chosen();

		$(document).ready(function() {
    		$('#enterpriseThanks').show();
	    	$('#userThanks').hide();
	    	$('#enterprisesButton').addClass('button-selected');
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

	    $('#openCompleteRegister').click(function() {
	    	$('#completeRegisterAlert').modal('hide');
	    	$('#completeRegister').modal('show');
	    });

	    $('#closeModal').click(function() {
	    	$('#completeRegisterAlert').modal('hide');	    	
	    });
	</script>

@endsection