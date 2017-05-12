@extends('layouts.app')

@section('content')

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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

    function formatCellphone(cellphone){ 
        if(cellphone.value.length == 0)
            cellphone.value = '(' + cellphone.value;
        if(cellphone.value.length == 3)
            cellphone.value = cellphone.value + ') ';
        if(cellphone.value.length == 10)
            cellphone.value = cellphone.value + '-';  
    }

    function formatDateOfBirth(dateOfBirth) {
        if(dateOfBirth.value.length == 2)
            dateOfBirth.value = dateOfBirth.value + '/';
        if(dateOfBirth.value.length == 5)
            dateOfBirth.value = dateOfBirth.value + '/';        
    }
    
</script>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="label-register form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-4 col-lg-4">
                        <br><br>
                        <label for="name" class="col-md-4 control-label label-register">NOME</label>                        
                        <input id="name" type="text" class="form-control label-register" name="name" value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register form-group{{ $errors->has('surName') ? ' has-error' : '' }} col-md-8 col-lg-8">
                        <br><br>
                        <label for="surName" class="col-md-4 control-label label-register">SOBRENOME</label>                        
                        <input id="surName" type="text" class="form-control label-register" name="surName" value="{{ old('surName') }}" required autofocus>
                        @if ($errors->has('surName'))
                            <span class="help-block">
                                <strong>{{ $errors->first('surName') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="gender">Sexo:</label>
                        <select id="gender" name="gender" class="form-control label-register" />
                            <option value="">Selecione o sexo</option>
                            <option value="Feminino">Feminino</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Outros">Outros</option>
                        </select>                                
                        @if ($errors->has('gender'))
                            <span class="help-block">
                                <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register form-group{{ $errors->has('dateOfBirth') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="dateOfBirth" class="col-md-12 control-label label-register">DATA DE NASCIMENTO</label>                        
                        <input id="dateOfBirth" type="date" class="form-control label-register" name="dateOfBirth" value="{{ old('dateOfBirth') }}" required autofocus maxlength="10" onkeypress="formatDateOfBirth(this)">
                        @if ($errors->has('dateOfBirth'))
                            <span class="help-block">
                                <strong>{{ $errors->first('dateOfBirth') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register form-group{{ $errors->has('telephone') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="telephone" class="col-md-4 control-label label-register">TELEFONE</label>                        
                        <input id="telephone" type="text" class="form-control label-register" name="telephone" value="{{ old('telephone') }}" required autofocus maxlength="14" onkeypress="formatTelephone(this)">
                        @if ($errors->has('telephone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('telephone') }}</strong>
                            </span>
                        @endif
                    </div>                    
                    <div class="label-register form-group{{ $errors->has('email') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="email" class="col-md-4 control-label label-register">E-MAIL</label>                        
                        <input id="email" type="email" class="form-control label-register" name="email" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register form-group{{ $errors->has('confirmEmail') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="confirmEmail" class="col-md-12 control-label label-register">CONFIRME SEU E-MAIL</label>                        
                        <input id="confirmEmail" type="email" class="form-control label-register" name="confirmEmail" value="{{ old('confirmEmail') }}" required autofocus>
                        @if ($errors->has('confirmEmail'))
                            <span class="help-block">
                                <strong>{{ $errors->first('confirmEmail') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register form-group{{ $errors->has('state') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="state" class="col-md-4 control-label label-register">ESTADO</label>                        
                        <select id="state" class="form-control label-register" name="state" value="{{ old('state') }}" required autofocus>
                            <option value="">Selecione o estado</option>
                        </select>    
                        @if ($errors->has('state'))
                            <span class="help-block">
                                <strong>{{ $errors->first('state') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="label-register form-group{{ $errors->has('city') ? ' has-error' : '' }} col-md-6 col-lg-6">
                        <br><br>
                        <label for="city" class="col-md-4 control-label label-register">CIDADE</label>                        
                        <select id="city" class="form-control label-register" name="city" value="{{ old('city') }}" required autofocus>
                        </select>    
                        @if ($errors->has('city'))
                            <span class="help-block">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                        @endif
                    </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Senha</label>
                            <div class="col-md-4">
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Senha</label>
                            <div class="col-md-4">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
