@extends('site.template')

@section('content')

<div class="container-fluid">
	<div class="row">
        <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0 nopadding">
            <img src="{{ URL::to('/') }}/images/banner.png" width="100%" />
        </div>
    </div>
    <div class="row">
        @if (!empty($success))
            <div class="alert alert-success col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
                {{ $success }}
            </div>    
        @endif
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopadding">
            <section class="contato">
	    		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3 contact-form">
	    			<h1>Fale conosco</h1>
	                <h2>Para falar conosco, envie uma mensagem utilizando o formul&aacute;rio abaixo.</h2>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/mensagem') }}">
                        {{ csrf_field() }}
    		            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3 contact-form">
    			        	<input type="text" name="name" id="name" placeholder="Digite seu nome">
    			    	</div>			        	
    			        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3 contact-form">
    			        	<input type="email" name="email" id="email" placeholder="Digite seu e-mail">
    			    	</div>			        	
    			        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3 contact-form">
    			        	<textarea name="message" id="message" placeholder="Digite sua mensagem"></textarea>
    			    	</div>			        	
    			        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3 contact-form">
    			        	<input type="submit" id="enviar" value="Enviar mensagem">
    			    	</div>
                    </form>    
				</div>    
			</section>				
        </div>
    </div>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 enterprise-register">
        	<span>Sua empresa ainda não está cadastrada? Clique <a href="#" data-toggle="modal" data-target="#enterprise">aqui</a> para cadastrá-la!</span>
        </div>
    </div>
</div>

<!-- Create Enterprise Modal -->
<div class="modal fade" id="enterprise" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <select name="category_id" class="form-control" v-model="newEnterprise.category_id" required />
                            <option value="">Selecione a categoria</option>
                            <option value="@{{ category.id }}" v-for="category in categories.data">@{{ category.name }}</option>
                        </select>
                        <span v-if="formErrors['category_id']" class="error text-danger">@{{ formErrors['category_id'] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input type="text" name="name" class="form-control" v-model="newEnterprise.name" required />
                        <span v-if="formErrors['name']" class="error text-danger">@{{ formErrors['name'] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contato:</label>
                        <input type="text" name="contact" class="form-control" v-model="newEnterprise.contact" required />
                        <span v-if="formErrors['contact']" class="error text-danger">@{{ formErrors['contact'] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="name">E-mail:</label>
                        <input type="email" name="email" class="form-control" v-model="newEnterprise.email" required />
                        <span v-if="formErrors['email']" class="error text-danger">@{{ formErrors['email'] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="site">Site:</label>
                        <input type="text" name="site" class="form-control" v-model="newEnterprise.site" required />
                        <span v-if="formErrors['site']" class="error text-danger">@{{ formErrors['site'] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="telephone">Celular:</label>
                        <input type="text" name="telephone" class="form-control" v-model="newEnterprise.telephone" required maxlength="15" onkeypress="formatTelephone(this)" />
                        <span v-if="formErrors['telephone']" class="error text-danger">@{{ formErrors['telephone'] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="state">Estado:</label>
                        <select name="state" id="state" class="form-control" v-model="newEnterprise.state" v-on:change="onChange" required>
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
                        <select name="city" id="city" class="form-control" v-model="newEnterprise.city" required>
                            <option v-for="option in options" v-bind:value="option">@{{ option }}</option>
                        </select>
                        <span v-if="formErrors['city']" class="error text-danger">@{{ formErrors['city'] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="neighborhood">Bairro:</label>
                        <input type="text" name="neighborhood" class="form-control" v-model="newEnterprise.neighborhood" required />
                        <span v-if="formErrors['neighborhood']" class="error text-danger">@{{ formErrors['neighborhood'] }}</span>
                    </div>
                    <div class="form-group">
                        <label for="address">Endereço:</label>
                        <input type="text" name="address" class="form-control" v-model="newEnterprise.address" required />
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

<script type="text/javascript">
    $('div.alert').delay(3000).slideUp(300);

    $(document).ready(function() {
        $('#cnpjLabel').hide();
        $('#cnpj').hide();
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

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/vue.resource/0.9.3/vue-resource.min.js"></script>
<script type="text/javascript" src="/js/site-enterprises.js"></script>

@endsection