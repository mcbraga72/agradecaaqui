@extends('site.template')

@section('content')
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=0zfrot4cp11wye4w5un16jq685zt2zsd0pqlbmpgobuylmno"></script>
	<script type="text/javascript">
	    tinymce.init({ 
	        selector:'textarea',
	        plugins: 'emoticons',
	        menubar: '',
	        toolbar: 'undo redo | cut copy paste | removeformat | bold italic | link image | emoticons' 
	    });	    
	</script>
	<div class="container-fluid">
		<div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0 nopadding">
                <img src="{{ URL::to('/') }}/images/banner.png" width="100%" alt="Banner - Agradeça Aqui" title="Banner - Agradeça Aqui" />
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-8 col-lg-offset-2 col-xl-8 col-xl-offset-2 home">
                <img class="logo" src="images/logo.png" alt="Logo - Agradeça Aqui" title="Logo - Agradeça Aqui" />
                <h1 class="thanks-text">O que você quer </h1><span class="pink"> agradecer </span><h1 class="thanks-text"> hoje?</h1>			
                <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
	                <button id="peopleButton" type="button" class="home"><img src="images/pessoas.png" alt="Agradeça pessoas" title="Agradeça pessoas" /></button>
	                <button id="enterprisesButton" type="button" class="home"><img src="images/empresas.png" alt="Agradeça empresas" title="Agradeça empresas" /></button>
	            </div>
	            @if(Auth::user())
                	<form class="form-horizontal" role="form" method="POST" id="enterpriseThanksForm">
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
			                        <textarea id="content-enterprise" name="content-enterprise" class="form-control" placeholder="Seu agradecimento aqui :)">@if(Session::has('content')) {{ Session::get('content') }} @endif</textarea>
			                        <div id="content-error" class="alert alert-danger thanks-messages">
		                    			<span>O campo agradecimento é obrigatório!</span>
		                			</div>
			                    </div>
			                </div>
			                <div class="form-group">
			                    <div class="col-md-6 col-md-offset-4">
			                    	<input type="submit" class="btn pink-button" value="Enviar" id="sendEnterpriseThanks">
			                    </div>
			                </div>
		                </div>
		            </form>
                @else
                	<form class="form-horizontal" role="form" method="POST" action="{{ url('entrar') }}">                
                	{{ csrf_field() }}			                
		                <div id="enterpriseThanks">		                
				            <div class="form-home form-group{{ $errors->has('enterprise_id') ? ' has-error' : '' }}">
				                <br><br>			                
				                <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
				                	@if (!empty($data['success']))
						                <div class="alert alert-success">
						                    {{ $data['success'] }}
						                </div>
						            @endif
						            @if (!empty($data['error']))
						                <div class="alert alert-danger">
						                    {{ $data['error'] }}
						                </div>
						            @endif
				                    <label for="enterprise_id" class="control-label form-home">EMPRESA</label>
				                    <select id="enterprise_id" name="enterprise_id" class="selectpicker form-control chosen-select" v-model="enterprise_id">
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
			                    	<label for="content" class="control-label form-home">AGRADEÇA AQUI</label><img class="heart-form" src="{{ asset('images/heart.png') }}" alt="Coração" title="Coração" />
			                        <textarea id="content" name="content" class="form-control" placeholder="Seu agradecimento aqui :)">{{ old('content') }}</textarea>
			                        @if ($errors->has('content'))
			                            <span class="help-block">
			                                <strong>{{ $errors->first('content') }}</strong>
			                            </span>
			                        @endif
			                    </div>
			                </div>
			                <div class="form-group">
			                    <input type="submit" class="btn pink-button" value="Enviar">
			                </div>
		                </div>
		            </form>
                @endif
                	
	            @if(Auth::user())
					<form class="form-horizontal" role="form" method="POST" id="userThanksForm">
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
			                    	<input type="submit" class="btn pink-button" value="Enviar" id="sendUserThanks">
			                    </div>
			                </div>
		                </div>
		            </form>
				@else
					<form class="form-horizontal login-form" role="form" method="POST" action="{{ url('entrar') }}">
						{{ csrf_field() }}
						<div id="userThanks">
			                <div class="form-home form-group{{ $errors->has('receiptName') ? ' has-error' : '' }}">
				                <br><br>
				                <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
				                	<label for="receiptName" class="control-label form-home">PARA</label>
				                    <input id="receiptName" type="text" class="form-control" name="receiptName" value="{{ old('receiptName') }}" autofocus placeholder="Nome">
				                    @if ($errors->has('receiptName'))
				                        <span class="help-block">
				                            <strong>{{ $errors->first('receiptName') }}</strong>
				                        </span>
				                    @endif
				                </div>
				            </div>
				            <div class="form-home form-group{{ $errors->has('receiptEmail') ? ' has-error' : '' }}">
			                    <br><br>
			                    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
			                    	<label for="receiptEmail" class="control-label form-home">E-MAIL</label>
			                        <input id="receiptEmail" type="email" class="form-control" name="receiptEmail" value="{{ old('receiptEmail') }}" autofocus placeholder="E-mail do destinatário">
			                        @if ($errors->has('receiptEmail'))
			                            <span class="help-block">
			                                <strong>{{ $errors->first('receiptEmail') }}</strong>
			                            </span>
			                        @endif
			                    </div>
			                </div>
			                <div class="form-home form-group{{ $errors->has('content') ? ' has-error' : '' }}">		                    
			                    <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3">
			                    	<label for="content" class="control-label form-home">AGRADEÇA AQUI</label><img class="heart-form" src="{{ asset('images/heart.png') }}" alt="Coração" title="Coração" />
			                        <textarea id="content" name="content" class="form-control" placeholder="Seu agradecimento aqui :)">{{ old('content') }}</textarea>
			                        @if ($errors->has('content'))
			                            <span class="help-block">
			                                <strong>{{ $errors->first('content') }}</strong>
			                            </span>
			                        @endif
			                    </div>
			                </div>
			                <div class="form-group">
			                    <input type="submit" class="btn pink-button" value="Enviar">
			                </div>
		                </div>
		            </form>
				@endif					
	        </div>	        
		</div>    
		<div class="row">
			<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0 col-xl-12 col-xl-offset-0 thanks">
				<img class="logo-login" src="images/logo.png" alt="Logo - Agradeça Aqui" title="Logo - Agradeça Aqui" />
                <h1 class="support">Agradecimentos</h1>			
				<form class="form-horizontal" role="form" method="POST" action="{{ url('busca') }}">
	            {{ csrf_field() }}
					<div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">
		                <br><br>
		                <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 col-xl-6 col-xl-offset-3">
		                    <input id="search" type="text" class="form-control" name="search" placeholder="Pesquisar por" required autofocus>
		                    @if ($errors->has('search'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('search') }}</strong>
		                        </span>
		                    @endif		                    
		                </div>
		            </div>
		            <div class="form-group">
		                <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-2 col-xl-offset-5">
		                    <button type="submit" class="btn pink-button search-button">Pesquisar</button>
		                </div>
		            </div>
		        </form>
	        	@forelse($data['enterpriseThanks'] as $enterpriseThank)
	        		<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-1 thanks-box">
	        			<img class="user-photo"src="{{ $enterpriseThank->photo }}" alt="Usuário que agradeceu" title="Usuário que agradeceu" /><p class="thanks-title">{{ $enterpriseThank->user }}</p><br>
	                    <img class="user-photo"src="{{ $enterpriseThank->logo }}" alt="Empresa que recebeu o agradecimento" title="Empresa que recebeu o agradecimento" /><p class="thanks-title">{{ $enterpriseThank->enterprise . " - " . $enterpriseThank->date }}</p>
	                    <img class="heart" src="images/heart.png" alt="Coração" title="Coração" />
	                    <p class="thaks-content">{{ strip_tags($enterpriseThank->content) }}</p>	                    
	                </div>    				
				@empty
    				<div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 col-xl-6 col-xl-offset-3 thanks-box">
	                    <img class="heart" src="images/heart.png" alt="Coração" title="Coração" />
	                    <p class="thaks-content">Ainda não existem agradecimentos cadastrados em nossa plataforma.</p>
	                </div>	                
				@endforelse
	        </div>    
	    </div>
    </div>

	<!-- Create Enterprise Modal -->
	<div class="modal fade" id="enterprise" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	                <span class="modal-name" id="myModalLabel">Cadastro de empresas</span>
	            </div>
	            <div class="modal-body">
	                <form method="POST" enctype="multipart/form-data" action="/agradecimento/cadastro/empresa">
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
	                        <label for="email">E-mail:</label>
	                        <input type="email" name="email" class="form-control" v-model="newEnterprise.email" />
	                        <span v-if="formErrors['email']" class="error text-danger">@{{ formErrors['email'] }}</span>
	                    </div>
	                    <div class="form-group">
	                        <label for="site">Site:</label>
	                        <input type="text" name="site" class="form-control" v-model="newEnterprise.site" />
	                        <span v-if="formErrors['site']" class="error text-danger">@{{ formErrors['site'] }}</span>
	                    </div>
	                    <div class="form-group">
	                        <label for="telephone">Telefone:</label>
	                        <input type="text" name="telephone" class="form-control" v-model="newEnterprise.telephone" maxlength="15" onkeypress="formatTelephone(this)" />
	                        <span v-if="formErrors['telephone']" class="error text-danger">@{{ formErrors['telephone'] }}</span>
	                    </div>
	                    <div class="form-group">
                            <label for="state">Estado:</label>
                            <select name="state" id="state" class="form-control" v-model="newEnterprise.state" v-on:change="onChange" required autofocus>
                                <option value="">Selecione o estado</option>
                                <option value="Acre">Acre</option>
                                <option value="Alagoas">Alagoas</option>
                                <option value="Amapá">Amapá</option>
                                <option value="Amazonas">Amazonas</option>
                                <option value="Bahia">Bahia</option>
                                <option value="Ceará">Ceará</option>
                                <option value="Distrito Federal">Distrito Federal</option>
                                <option value="Espírito Santo">Espírito Santo</option>
                                <option value="Goiás">Goiás</option>
                                <option value="Maranhão">Maranhão</option>
                                <option value="Mato Grosso">Mato Grosso</option>
                                <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                                <option value="Minas Gerais">Minas Gerais</option>
                                <option value="Pará">Pará</option>
                                <option value="Paraíba">Paraíba</option>
                                <option value="Paraná">Paraná</option>
                                <option value="Pernambuco">Pernambuco</option>
                                <option value="Piauí">Piauí</option>
                                <option value="Rio de Janeiro">Rio de Janeiro</option>
                                <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                                <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                                <option value="Rondônia">Rondônia</option>
                                <option value="Roraima">Roraima</option>
                                <option value="Santa Catarina">Santa Catarina</option>
                                <option value="Sergipe">Sergipe</option>
                                <option value="São Paulo">São Paulo</option>
                                <option value="Tocantins">Tocantins</option>
                            </select>    
                            <span v-if="formErrors['state']" class="error text-danger">@{{ formErrors['state'] }}</span>
                        </div>
                        <div class="form-group">
                            <label for="city">Cidade:</label>
                            <select name="city" id="city" class="form-control" v-model="newEnterprise.city" required autofocus>
                                <option v-for="option in options" v-bind:value="option">@{{ option }}</option>
                            </select>
                            <span v-if="formErrors['city']" class="error text-danger">@{{ formErrors['city'] }}</span>
                        </div>
                        <div class="form-group">
                            <label for="neighborhood">Bairro:</label>
                            <input type="text" name="neighborhood" class="form-control" v-model="newEnterprise.neighborhood" />
                            <span v-if="formErrors['neighborhood']" class="error text-danger">@{{ formErrors['neighborhood'] }}</span>
                        </div>
	                    <div class="form-group">
	                        <label for="address">Endereço:</label>
	                        <input type="text" name="address" class="form-control" v-model="newEnterprise.address" />
	                        <span v-if="formErrors['address']" class="error text-danger">@{{ formErrors['address'] }}</span>
	                    </div>
	                    <div class="form-group">
                            <label for="type">Tipo:</label><br>
                            <input type="radio" name="type" value="pf">Pessoa Física<br>
                            <input type="radio" name="type" value="pj">Pessoa Jurídica<br>
                        </div>
                        <div class="form-group">
                            <label for="cpf" id="cpfLabel">CPF:</label>
                            <input type="text" id="cpf" name="cpf" class="form-control" v-model="newEnterprise.cpf" maxlength="14" onkeypress="return formatCPF(this, event)" />
                            <span v-if="formErrors['cpf']" class="error text-danger">@{{ formErrors['cpf'] }}</span>
                        </div>
                        <div class="form-group">
                            <label for="cnpj" id="cnpjLabel">CNPJ:</label>
                            <input type="text" id="cnpj" name="cnpj" class="form-control" v-model="newEnterprise.cnpj" maxlength="18" onkeypress="return formatCNPJ(this, event)" />
                            <span v-if="formErrors['cnpj']" class="error text-danger">@{{ formErrors['cnpj'] }}</span>
                        </div>
	                    <div class="form-group">
	                        <button type="submit" class="btn btn-success">Enviar</button>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>    

	<script type="text/javascript" src="/js/vendor/chosen/chosen.jquery.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		$('.chosen-select').chosen();

		$(document).ready(function() {
    		$('#enterpriseThanks').show();
	    	$('#userThanks').hide();
	    	$('#enterprisesButton').addClass('button-selected');
	    	$(this).scrollTop(0);
	    	var page = "{!! $data['page'] !!}";
	    	if(page  == 'search') {
	    		$('html, body').animate({
			        scrollTop: $('#search').offset().top - 20
			    }, 'fast');	    		
	    	}
	    	$('#cnpjLabel').hide();
            $('#cnpj').hide();
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

	    $('input[name=type]').on('click', function(e) {
            if ($('input[name=type]:checked').val() == 'pj') {
                $('#cnpjLabel').show();
                $('#cnpj').show();
                $('#cpfLabel').hide();
                $('#cpf').hide();
            } else {                
                $('#cpfLabel').show();
                $('#cpf').show();
                $('#cnpjLabel').hide();
                $('#cnpj').hide();
            }
        });	

	    $('div.alert').delay(6000).slideUp(300);

	    $('#sendEnterpriseThanks').click(function(){
			$("#enterpriseThanksForm").submit(function(e){
			    return false;
			});

			var content = tinymce.get('content-enterprise').getContent();

			if ($('#enterprise_id').val() == null || $('#enterprise_id').val() == 0) {
				$('#enterprise-error').show();
    			$('#enterprise-error').delay(3000).slideUp(500);
                return false;
            } else if (content == '') {
            	$('#content-error').show();
                $('#content-error').delay(3000).slideUp(500);
                return false;
            } else {
            	$.ajax({
                    url:'/app/agradecimento-empresa',
                    type:'POST',
                    async: false,
                    data: {enterprise_id: $('#enterprise_id').val(), content: content, "_token": "{{ csrf_token() }}"},
                    success: function(data) {
                    	$('#enterprise_id').val("Selecione a empresa");
    					$('#enterprise_id').trigger('chosen:updated');
    					tinymce.get('content-enterprise').setContent('');    					
                    }
                });

                $.ajax({
                    url:'/',
                    type:'GET',
                    async: true,
                    success: function(data) {
                    	$(document.body).html(data);
                    	$(window).scrollTop(0);
                    	toastr.success('Agradecimento cadastrado com sucesso!', '', {timeOut: 3000});
                    }
                });
            }
        });

        $('#sendUserThanks').click(function(){
			$("#userThanksForm").submit(function(e){
			    return false;
			});

			var content = tinymce.get('contentUser').getContent();

			if ($('#receiptName').val() == null || $('#receiptName').val() == '') {
				$('#receiptName-error').show();
    			$('#receiptName-error').delay(3000).slideUp(500);
                return false;
            } else if ($('#receiptEmail').val() == null || $('#receiptEmail').val() == '') {
            	$('#receiptEmail-error').show();
    			$('#receiptEmail-error').delay(3000).slideUp(500);
                return false;
            } else if(contentUser == '') {
            	$('#userContent-error').show();
                $('#userContent-error').delay(3000).slideUp(500);
                return false;
            } else {
            	$.ajax({
                    url:'/app/agradecimento-usuario',
                    type:'POST',
                    async: false,
                    data: {receiptName: $('#receiptName').val(), receiptEmail: $('#receiptEmail').val(), content: content, "_token": "{{ csrf_token() }}"},
                    success: function(data) {                    	
    	        		$('#receiptName').val('');
						$('#receiptEmail').val('');
						tinymce.get('contentUser').setContent('');					
                    }
                });

                $.ajax({
                    url:'/',
                    type:'GET',
                    async: true,
                    success: function(data) {
                    	$(document.body).html(data);
                    	$(window).scrollTop(0);
                    	toastr.success('Agradecimento cadastrado com sucesso!', '', {timeOut: 3000});
                    }
                });
            }
        });

	    function formatTelephone(telephone){ 
	        if(telephone.value.length == 0)
	            telephone.value = '(' + telephone.value;
	        if(telephone.value.length == 3)
	            telephone.value = telephone.value + ') ';
	        if(telephone.value.length == 10)
	            telephone.value = telephone.value + '-';  
	    }

	    function formatCPF(cpf, evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            } else {
                if(cpf.value.length == 3)
                    cpf.value = cpf.value + '.';
                if(cpf.value.length == 7)
                    cpf.value = cpf.value + '.';
                if(cpf.value.length == 11)
                    cpf.value = cpf.value + '-';
                return true;
            }
        }

        function formatCNPJ(cnpj, evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            } else {
                if(cnpj.value.length == 2)
                    cnpj.value = cnpj.value + '.';
                if(cnpj.value.length == 6)
                    cnpj.value = cnpj.value + '.';
                if(cnpj.value.length == 10)
                    cnpj.value = cnpj.value + '/';
                if(cnpj.value.length == 15)
                    cnpj.value = cnpj.value + '-';
                return true;
            }
        }
	</script>
	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/vue.resource/0.9.3/vue-resource.min.js"></script>    
    <script type="text/javascript" src="{{ URL::to('/') }}/js/site-enterprises.js"></script>	
    <script type="text/javascript" src="{{ URL::to('/') }}/js/app-users.js"></script>

@endsection
