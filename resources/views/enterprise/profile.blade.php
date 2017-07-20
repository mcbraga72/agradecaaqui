@extends('enterprise.layout')

@section('content')

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript"> 
        
    function formatTelephone(telephone){ 
        if(telephone.value.length == 0)
            telephone.value = '(' + telephone.value;
        if(telephone.value.length == 3)
            telephone.value = telephone.value + ') ';
        if(telephone.value.length == 10)
            telephone.value = telephone.value + '-';  
    }
    
</script>

<div class="container-fluid login-register">
    <div class="row">    
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p style="margin-top: 2%;">Perfil</p>
        </div>
    </div>
    <div class="row">    
        <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
            <div class="">                
                <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateLogo()">
                    {{ csrf_field() }}
                    <div class="form-group col-lg-12">
                        <div class="form-group col-lg-8">
                            <label for="logo" class="btn"><img src="{{ URL::to('/') . '/' . Auth::guard('enterprises')->user()->logo }}" style="border-radius: 50%; width: 80px; height: 80px;" /></label>
                            <button type="submit" class="btn btn-primary" style="display: inline !important;">Atualizar Logo</button>
                            <input type="file" name="logo" id="logo" class="form-control" v-model="logo" style="display: inline !important;">
                            <span v-if="formErrors['logo']" class="error text-danger">@{{ formErrors['logo'] }}</span>                                        
                        </div>
                    </div>                                
                </form>
                <form class="form" role="form" method="POST" action="{{ url('/empresa/perfil/atualizar') }}">
                    {{ csrf_field() }}
                    <div class="label-register enterprise-profile form-group{{ $errors->has('category_id') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="category_id" class="col-md-6 control-label label-register">Categoria</label>
                        <select name="category_id" class="form-control" />
                            <option value="">Selecione a categoria</option>
                            @foreach($categories as $category)
                                @if($enterprise->category_id == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif    
                            @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('category_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="name" class="col-md-6 control-label label-register">Nome da empresa</label>
                        <input id="name" type="text" class="form-control label-register" name="name" value="{{ $enterprise->name }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('contact') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="contact" class="col-md-6 control-label label-register">Contato</label>
                        <input id="contact" type="text" class="form-control label-register" name="contact" value="{{ $enterprise->contact }}" required autofocus>
                        @if ($errors->has('contact'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contact') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('telephone') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="telephone" class="col-md-6 control-label label-register">Celular</label>
                        <input id="telephone" type="text" class="form-control label-register" name="telephone" value="{{ $enterprise->telephone }}" required maxlength="15" onkeypress="formatTelephone(this)">
                        @if ($errors->has('telephone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('telephone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('email') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="email" class="col-md-6 control-label label-register">E-mail</label>
                        <input id="email" type="email" class="form-control label-register" name="email" value="{{ $enterprise->email }}" required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('site') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="site" class="col-md-6 control-label label-register">Site</label>
                        <input id="site" type="text" class="form-control label-register" name="site" value="{{ $enterprise->site }}" required>
                        @if ($errors->has('site'))
                            <span class="help-block">
                                <strong>{{ $errors->first('site') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('state') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="state" class="col-md-6 control-label label-register">Estado</label>
                        <select name="state" id="state" class="form-control label-register" v-model="state" />
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
                        @if ($errors->has('state'))
                            <span class="help-block">
                                <strong>{{ $errors->first('state') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('city') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="city" class="col-md-6 control-label label-register">Cidade</label>
                        <select id="city" name="city" class="form-control" v-model="city" />
                            <option value="">Selecione a cidade</option>
                            <option v-for="option in options" v-bind:value="option" selected="@{{city == option}}">@{{ option }}</option>
                            <option value="{{ Auth::user()->city }}" selected="selected">{{ Auth::user()->city }}</option>
                        </select>
                        @if ($errors->has('city'))
                            <span class="help-block">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('neighborhood') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="neighborhood" class="col-md-6 control-label label-register">Bairro</label>
                        <input type="text" name="neighborhood" class="form-control label-register" value="{{ $enterprise->neighborhood }}" />
                        @if ($errors->has('neighborhood'))
                            <span class="help-block">
                                <strong>{{ $errors->first('neighborhood') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('address') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="address" class="col-md-6 control-label label-register">Endereço</label>
                        <input id="address" type="text" class="form-control label-register" name="address" value="{{ $enterprise->address }}" required autofocus>
                        @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>                    
                    <div class="label-register enterprise-profile form-group col-md-6 col-lg-6">
                        <br><br>
                        <input type="radio" name="type" value="pf" style="margin-left: 4%;"> Pessoa Física
                        <input type="radio" name="type" value="pj" style="margin-left: 5%;"> Pessoa Jurídica
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('cpf') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="cpf" id="cpfLabel" class="col-md-6 control-label label-register">CPF</label>
                        <input type="text" id="cpf" name="cpf" class="form-control label-register" value="{{ $enterprise->cpf }}" maxlength="14" onkeypress="return formatCPF(this, event)" />
                        @if ($errors->has('cpf'))
                            <span class="help-block">
                                <strong>{{ $errors->first('cpf') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register enterprise-profile form-group{{ $errors->has('cnpj') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <label for="cnpj" id="cnpjLabel" class="col-md-6 control-label label-register">CNPJ</label>
                        <input type="text" id="cnpj" name="cnpj" class="form-control label-register" value="{{ $enterprise->cnpj }}" maxlength="18" onkeypress="return formatCNPJ(this, event)" />
                        @if ($errors->has('cnpj'))
                            <span class="help-block">
                                <strong>{{ $errors->first('cnpj') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-lg-12">
                            <button type="submit" class="btn btn-success" style="margin-top: 2%;">Atualizar Dados</button>                        
                        </div>
                    </div>
                </form>
            </div>
        </div>        
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/vue.resource/0.9.3/vue-resource.min.js"></script>
<script type="text/javascript" src="/js/app-enterprises.js"></script>
<script type="text/javascript">
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
@endsection
