@extends('layouts.app')

@section('content')

<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript"> 
        
    $(document).ready(function () {
    
        $.getJSON('estados_cidades.json', function (data) {

            var items = [];
            var options = '<option value="">Selecione o estado</option>';    

            $.each(data, function (key, val) {
                options += '<option value="' + val.nome + '">' + val.nome + '</option>';
            });                 
            $("#state").html(options);                
            
            $("#state").change(function () {              
            
                var options_city = '';
                var str = "";                   
                
                $("#state option:selected").each(function () {
                    str += $(this).text();
                });
                
                $.each(data, function (key, val) {
                    if(val.nome == str) {                           
                        $.each(val.cidades, function (key_city, val_city) {
                            options_city += '<option value="' + val_city + '">' + val_city + '</option>';
                        });                         
                    }
                });

                $("#city").html(options_city);
                
            }).change();        
        
        });
    
    });

    function formatTelephone(telephone){ 
        if(telephone.value.length == 0)
            telephone.value = '(' + telephone.value;
        if(telephone.value.length == 3)
            telephone.value = telephone.value + ') ';
        if(telephone.value.length == 9)
            telephone.value = telephone.value + '-';  
    }    
    
</script>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Cadastro</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('/empresa/cadastro') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="category" class="col-md-4 control-label">Categoria</label>
                            <div class="col-md-6">
                                <!--<input id="category" type="text" class="form-control" name="category" value="{{ old('category') }}" required autofocus>-->
                                <select class="selectpicker">
                                    <option value="0">Selecione a categoria</option>
                                    @foreach ($categories as $category) 
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>           
                                    @endforeach                         
                                </select>
                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nome</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('site') ? ' has-error' : '' }}">
                            <label for="site" class="col-md-4 control-label">Site</label>
                            <div class="col-md-6">
                                <input id="site" type="text" class="form-control" name="site" value="{{ old('site') }}" required>
                                @if ($errors->has('site'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('site') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('cnpj') ? ' has-error' : '' }}">
                            <label for="cnpj" class="col-md-4 control-label">CNPJ</label>
                            <div class="col-md-6">
                                <input id="cnpj" type="text" class="form-control" name="cnpj" value="{{ old('cnpj') }}" required>
                                @if ($errors->has('cnpj'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cnpj') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Endereço</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                            <label for="telephone" class="col-md-4 control-label">E-Mail</label>
                            <div class="col-md-6">
                                <input id="telephone" type="text" class="form-control" name="telephone" value="{{ old('telephone') }}" required>
                                @if ($errors->has('telephone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telephone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="label-register form-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-4 col-lg-4">
                            <label for="password" class="col-md-4 control-label label-register">SENHA</label>                        
                            <input id="password" type="password" class="form-control label-register" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="label-register form-group{{ $errors->has('password-confirm') ? ' has-error' : '' }} col-md-4 col-lg-4">
                            <label for="password-confirm" class="col-md-12 control-label label-register">CONFIRME SUA SENHA</label>                        
                            <input id="password-confirm" type="password" class="form-control col-md-4 label-register" name="password-confirm" required>
                            @if ($errors->has('password-confirm'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password-confirm') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
