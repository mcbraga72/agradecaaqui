@extends('site.template')

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
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0 nopadding">
                <img src="{{ URL::to('/') }}/images/banner.png" width="100%" />
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-8 col-lg-offset-2 col-xl-8 col-xl-offset-2 home">
                <img class="logo" src="images/logo.png" />
                <h1 class="thanks-text">O que você quer </h1><span class="pink"> agradecer </span><h1 class="thanks-text"> hoje?</h1>			
                <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
	                <button id="peopleButton" type="button" class="home"><img src="images/pessoas.png" /></button>
	                <button id="enterprisesButton" type="button" class="home"><img src="images/empresas.png" /></button>
	            </div>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('entrar') }}">                
                	{{ csrf_field() }}			                
	                <div id="enterpriseThanks">		                
			            <div class="form-home form-group{{ $errors->has('enterprise_id') ? ' has-error' : '' }}">
			                <br><br>			                
			                <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
			                    <label for="enterprise_id" class="col-md-4 control-label">EMPRESA</label>
			                    <select id="enterprise_id" name="enterprise_id" class="selectpicker form-control chosen-select">
                                    <option value="">Selecione a empresa</option>
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
			            <div class="form-home form-group{{ $errors->has('content') ? ' has-error' : '' }}">
		                    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
		                    	<label for="content" class="col-md-4 col-lg-6 control-label">AGRADEÇA AQUI</label><img class="heart-form" src="images/heart.png" />
		                        <textarea id="content" name="content" class="form-control" placeholder="Seu agradecimento aqui :)">{{ old('content') }}</textarea>
		                        @if ($errors->has('content'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('content') }}</strong>
		                            </span>
		                        @endif
		                    </div>
		                </div>
		                <div class="form-group">
		                    <input type="submit" class="btn pink-button" value="ENVIAR">		                    
		                </div>
	                </div>
	            </form>
				<form class="form-horizontal login-form" role="form" method="POST" action="{{ url('entrar') }}">
					{{ csrf_field() }}
					<div id="userThanks">
		                <div class="form-home form-group{{ $errors->has('userName') ? ' has-error' : '' }}">
			                <br><br>
			                <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
			                	<label for="userName" class="col-md-4 control-label">PARA</label>
			                    <input id="userName" type="text" class="form-control" name="userName" value="{{ old('userName') }}" autofocus placeholder="Nome">
			                    @if ($errors->has('userName'))
			                        <span class="help-block">
			                            <strong>{{ $errors->first('userName') }}</strong>
			                        </span>
			                    @endif
			                </div>
			            </div>
			            <div class="form-home form-group{{ $errors->has('userEmail') ? ' has-error' : '' }}">
		                    <br><br>
		                    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
		                    	<label for="userEmail" class="col-md-4 control-label">E-MAIL</label>
		                        <input id="userEmail" type="email" class="form-control" name="userEmail" value="{{ old('userEmail') }}" autofocus placeholder="E-mail do destinatário">
		                        @if ($errors->has('userEmail'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('userEmail') }}</strong>
		                            </span>
		                        @endif
		                    </div>
		                </div>
		                <div class="form-home form-group{{ $errors->has('content') ? ' has-error' : '' }}">		                    
		                    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
		                    	<label for="content" class="col-md-4 col-lg-6 control-label form-home">AGRADEÇA AQUI</label><img class="heart-form" src="images/heart.png" />
		                        <textarea id="content" name="content" class="form-control" placeholder="Seu agradecimento aqui :)">{{ old('content') }}</textarea>
		                        @if ($errors->has('content'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('content') }}</strong>
		                            </span>
		                        @endif
		                    </div>
		                </div>
		                <div class="form-group">
		                    <div class="col-md-6 col-md-offset-4">
		                    	<button type="submit" class="btn pink-button">ENVIAR</button>
		                    </div>
		                </div>
	                </div>
	            </form>                
	        </div>	        
		</div>    
		<div class="row">
			<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0 col-xl-12 col-xl-offset-0 thanks">
				<img class="logo-login" src="images/logo.png" />
                <h1 class="support">Comentários</h1>			
				<form class="form-horizontal" role="form" method="POST" action="{{ url('busca') }}">
	            {{ csrf_field() }}
					<div class="form-group{{ $errors->has('busca') ? ' has-error' : '' }}">
		                <br><br>
		                <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 col-xl-6 col-xl-offset-3">
		                    <input id="busca" type="busca" class="form-control" name="busca" value="{{ old('busca') }}" placeholder="Pesquisar por" required autofocus>
		                    @if ($errors->has('busca'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('busca') }}</strong>
		                        </span>
		                    @endif		                    
		                </div>
		            </div>
		            <div class="form-group">
		                <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-2 col-xl-offset-5">
		                    <button type="submit" class="btn pink-button">Pesquisar</button>
		                </div>
		            </div>
		        </form>
	        	@forelse($data['enterpriseThanks'] as $enterpriseThank)
	        		<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-1 col-lg-3 col-xl-2 col-xl-offset-1 thanks-box">
	                    <p class="thanks-title">{{ $enterpriseThank->name }}</p>
	                    <img class="heart" src="images/heart.png" />
	                    <p class="thaks-content">{{ strip_tags($enterpriseThank->content) }}</p>
	                    <img class="user-photo"src="{{ $enterpriseThank->logo }}" alt="Agradecimento" title="Agradecimento" />	                    
	                </div>    				
				@empty
    				<div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 col-xl-6 col-xl-offset-3 thanks-box">
	                    <img class="heart" src="images/heart.png" />
	                    <p class="thaks-content">Ainda não existem agradecimentos cadastrados em nossa plataforma.</p>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 show-more">
						<img class="plus" src="images/plus.png" alt="Mostrar mais" title="Mostrar mais" />
	                </div>
				@endforelse
	        </div>    
	    </div>
    </div>

	<!-- Create Enterprise Modal -->
	<div class="container administrators" id="enterprises">
	    <div class="modal fade" id="createEnterprise" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	                    <h4 class="modal-name" id="myModalLabel">Cadastro de empresas</h4>
	                </div>
	                <div class="modal-body">
	                    <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createEnterprise">
	                    	<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
	                        <div class="form-group">
	                            <label for="category_id">Categoria:</label>
	                            <select name="category_id" class="form-control" v-model="newEnterprise.category_id" />
	                                <option value="">Selecione a categoria</option>
	                                <option value="@{{ category.id }}" v-for="category in categories.data">@{{ category.name }}</option>
	                            </select>
	                            <span v-if="formErrors['category_id']" class="error text-danger">@{{ formErrors['category_id'] }}</span>
	                        </div>
	                        <div class="form-group">
	                            <label for="name">Nome:</label>
	                            <input type="text" name="name" class="form-control" v-model="newEnterprise.name" />
	                            <span v-if="formErrors['name']" class="error text-danger">@{{ formErrors['name'] }}</span>
	                        </div>
	                        <div class="form-group">
	                            <label for="contact">Contato:</label>
	                            <input type="text" name="contact" class="form-control" v-model="newEnterprise.contact" />
	                            <span v-if="formErrors['contact']" class="error text-danger">@{{ formErrors['contact'] }}</span>
	                        </div>
	                        <div class="form-group">
	                            <label for="name">E-mail:</label>
	                            <input type="email" name="email" class="form-control" v-model="newEnterprise.email" />
	                            <span v-if="formErrors['email']" class="error text-danger">@{{ formErrors['email'] }}</span>
	                        </div>
	                        <div class="form-group">
	                            <label for="telephone">Telefone:</label>
	                            <input type="text" name="telephone" class="form-control" v-model="newEnterprise.telephone" />
	                            <span v-if="formErrors['telephone']" class="error text-danger">@{{ formErrors['telephone'] }}</span>
	                        </div>
	                        <div class="form-group">
	                            <label for="address">Endereço:</label>
	                            <input type="text" name="address" class="form-control" v-model="newEnterprise.address" />
	                            <span v-if="formErrors['address']" class="error text-danger">@{{ formErrors['address'] }}</span>
	                        </div>
	                        <div class="form-group">
	                            <button type="submit" class="btn btn-success">Enviar</button>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>    

	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/vue.resource/0.9.3/vue-resource.min.js"></script>
    <script src="/js/vendor/chosen/chosen.jquery.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="/js/app-enterprises.js"></script>
	<script type="text/javascript">
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
	</script>

@endsection