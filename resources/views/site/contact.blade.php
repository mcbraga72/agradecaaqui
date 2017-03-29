@extends('site.template')

@section('content')

<div class="container-fluid">
	<div class="row">
        <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0 nopadding">
            <img src="{{ URL::to('/') }}/images/banner.png" width="100%" />
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopadding">
            <section class="contato">
	    		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3 contact-form">
	    			<h1>Fale conosco</h1>
	                <h2>Para falar conosco, envie uma mensagem utilizando o formul&aacute;rio abaixo.</h2>		            
		            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3 contact-form">
			        	<input type="text" id="nome" placeholder="Digite seu nome">
			    	</div>			        	
			        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3 contact-form">
			        	<input type="email" id="email" placeholder="Digite seu e-mail">
			    	</div>			        	
			        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3 contact-form">
			        	<textarea id="assunto" placeholder="Digite sua mensagem"></textarea>
			    	</div>			        	
			        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3 contact-form">
			        	<input type="submit" id="enviar" value="Enviar mensagem">
			    	</div>
				</div>    
			</section>				
        </div>
    </div>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 enterprise-register">
        	<span>Sua empresa ainda não está cadastrada? Clique <a href="#" data-toggle="modal" data-target="#createEnterprise">aqui</a> para cadastrá-la!</span>
        </div>
    </div>
</div>

<!-- Create Enterprise Modal -->
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

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/vue.resource/0.9.3/vue-resource.min.js"></script>
<script type="text/javascript" src="/js/site-enterprises.js"></script>

@endsection