@extends('app.template')

@section('content')
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=0zfrot4cp11wye4w5un16jq685zt2zsd0pqlbmpgobuylmno"></script>
	<script type="text/javascript">
	    tinymce.init({ 
	        selector:'textarea',
	        forced_root_block : false,
	        format: 'raw',
	        plugins: 'emoticons',
	        menubar: '',
	        toolbar: 'undo redo | cut copy paste | styleselect | bold italic | link image | emoticons' 
	    });	    
	</script>
	<div class="container-fluid">
		<div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 home">
            	@if (!empty($success))
	                <div class="alert alert-success">
	                    {{ $success }}
	                </div>
	            @endif
	            <img class="logo" src="{{ asset('images/logo.png') }}" />
                <h1 class="thanks-text">O que você quer </h1><span class="pink"> agradecer </span><h1 class="thanks-text"> hoje?</h1>			
                <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
	                <button id="peopleButton" type="button" class="home"><img src="{{ asset('images/pessoas.png') }}" /></button>
	                <button id="enterprisesButton" type="button" class="home"><img src="{{ asset('images/empresas.png') }}" /></button>
	            </div>
                <form class="form-horizontal" role="form" method="POST" action="/app/agradecimento-empresa">
                	{{ csrf_field() }}
	                <div id="enterpriseThanks">		                
			            <div class="form-home form-group">
			                <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
			                	<label for="enterprise_id" class="control-label form-home">EMPRESA</label>
			                    <select id="enterprise_id" name="enterprise_id" data-placeholder="Selecione a empresa" class="selectpicker form-control chosen-select" v-model="newEnterpriseThanks.enterprise_id">
                                    <option value="0">Selecione a empresa</option>
                                    @foreach ($data['enterprises'] as $enterprise)
                                    	@if (Session::has('enterprise_id') && $enterprise->id == Session::get('enterprise_id'))
                                    		<option value="{{ $enterprise->id }}" selected>{{ $enterprise->name }}</option>
                                    	@else
											<option value="{{ $enterprise->id }}">{{ $enterprise->name }}</option>
                                    	@endif
                                    @endforeach                         
                                </select>
			                    <div id="enterprise-error" class="alert alert-danger thanks-messages">
	                    			<span>Por favor, selecione uma empresa!</span>
	                			</div>
			                </div>
			            </div>
			            <div class="form-home form-group">
		                    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
		                    	<label for="content" class="control-label form-home">AGRADEÇA AQUI</label><img class="heart-form" src="{{ asset('images/heart.png') }}" alt="Coração" title="Coração" />
		                        <textarea id="contentEnterprise" name="contentEnterprise" class="form-control" placeholder="Seu agradecimento aqui :)">@if(Session::has('content')) {{ Session::get('content') }} @endif</textarea>
		                        <div id="content-error" class="alert alert-danger thanks-messages">
	                    			<span>O campo agradecimento é obrigatório!</span>
	                			</div>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <div class="col-md-6 col-md-offset-4">
		                    	<input type="submit" class="btn pink-button" value="Enviar">
		                    </div>
		                </div>
	                </div>
	            </form>
				<form class="form-horizontal" role="form" method="POST" action="/app/agradecimento-usuario">
					{{ csrf_field() }}
					<div id="userThanks">
		                <div class="form-home form-group">
			                <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
			                	<label for="receiptName" class="control-label form-home">PARA</label>
			                    <input id="receiptName" type="text" class="form-control" name="receiptName" @if(Session::has('receiptName')) value="{{ Session::get('receiptName') }}" @else value="{{ old('receiptName') }}" @endif placeholder="Nome">
			                    <div id="receiptName-error" class="alert alert-danger thanks-messages">
	                    			<span>O campo nome é obrigatório!</span>
	                			</div>
			                </div>
			            </div>
			            <div class="form-home form-group">
		                    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
		                    	<label for="receiptEmail" class="control-label form-home">E-MAIL</label>
		                        <input id="receiptEmail" type="text" class="form-control" name="receiptEmail" @if(Session::has('receiptEmail')) value="{{ Session::get('receiptEmail') }}" @else value="{{ old('receiptEmail') }}" @endif placeholder="E-mail do destinatário">
		                        <div id="receiptEmail-error" class="alert alert-danger thanks-messages">
	                    			<span>O campo e-mail é obrigatório!</span>
	                			</div>
		                    </div>
		                </div>
		                <div class="form-home form-group">
		                    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
		                    	<label for="content" class="control-label form-home">AGRADEÇA AQUI</label><img class="heart-form" src="{{ asset('images/heart.png') }}" alt="Coração" title="Coração" />
		                        <textarea id="contentUser" name="contentUser" class="form-control" placeholder="Seu agradecimento aqui :)">@if(Session::has('content')) {{ Session::get('content') }} @endif</textarea>
		                        <div id="userContent-error" class="alert alert-danger thanks-messages">
	                    			<span>O campo agradecimento é obrigatório!</span>
	                			</div>
		                    </div>
		                </div>
		                <div class="form-group">
		                    <div class="col-md-6 col-md-offset-4">
		                    	<input type="submit" class="btn pink-button" value="Enviar">
		                    </div>
		                </div>
	                </div>
	            </form>
	            <br><br>	
                <img class="logo-login" src="{{ asset('images/logo.png') }}" />
                <h1 class="support">Meus agradecimentos</h1>			
				<form class="form-horizontal" role="form" method="POST" action="{{ url('/app/agradecimentos/busca') }}">
	            {{ csrf_field() }}
					<div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">
		                <br><br>
		                <div class="col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
		                    <input type="text" class="form-control search" id="search" name="search" placeholder="Pesquisar por" required>
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
			<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
	        	@forelse($data['allThanks'] as $allThank)
	        		<div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-5 col-md-offset-1 col-lg-5 col-lg-offset-1 thanks-box">
	                    <div class="col-lg-12">
	                    	@if($allThank->type == 'enterpriseThanks')
	                    		<a href="{{ route('enterprise-thanks.show', $allThank->hash) }}"><img class="heart" src="{{ asset('images/heart.png') }}" /></a>
	                    	@else
	                    		<a href="{{ route('user-thanks.show', $allThank->hash) }}"><img class="heart" src="{{ asset('images/heart.png') }}" /></a>
	                    	@endif
	                    </div>
	                    <div class="col-lg-12">
							@if($allThank->logo == 'people')
		                    	<img class="user-photo" src="{{ URL::to('/') }}/images/people.png" alt="Agradecimento para pessoas" title="Agradecimento para pessoas" />	                    
		                    @else
		                    	<img class="user-photo" src="{{ asset($allThank->logo) }}" alt="Agradecimento para empresas" title="Agradecimento para empresas" />
		                    @endif
							<p class="thanks-title">{{ $allThank->name . " - " . $allThank->date }}</p>	                    	
	                    	<p class="thaks-content">{{ strip_tags($allThank->content) }}</p>		                    
		                </div>    
	                </div>    				
				@empty
    				<div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 col-xl-6 col-xl-offset-3 thanks-box">
	                    <img class="heart" src="{{ asset('images/heart.png') }}" />
	                    <p class="thaks-content">Você ainda não fez nenhum agradecimento em nossa plataforma.</p>
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
                	<img class="logo" src="{{ asset('images/logo.png') }}" />
                	<h4 class="modal-name complete-register" id="myModalLabel">Complete seu cadastro</h4><br>
                </div>	
                <div class="modal-footer">	
                	<button type="button" id="openCompleteRegister" onclick="location.href='{{ url('app/usuario/' . Auth::user()->id . '/edit') }}';" class="btn btn-success" data-dismiss="modal" aria-label="Close">Quero preencher<i class="fa fa-check fa-fw" aria-hidden="true"></i></button>
                	<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Agora não<i class="fa fa-times fa-fw" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/vue.resource/0.9.3/vue-resource.min.js"></script>    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript" src="/js/vendor/chosen/chosen.jquery.js"></script>
    <script type="text/javascript" src="/js/app-users.js"></script>

	<script type="text/javascript">
		$('div.alert').delay(5000).slideUp(500);

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
