@extends('site.template')

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
            $("#state").val('{{ old('state') }}');
            
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
                $("#city").val('{{ old('city') }}');
                
            }).change();        

            var options_city = '<option value="">Selecione antes o estado</option>';
            $("#city").html(options_city);            
        
        });
    
    });

    function formatTelephone(telephone){ 
        if(telephone.value.length == 0)
            telephone.value = '(' + telephone.value;
        if(telephone.value.length == 3)
            telephone.value = telephone.value + ') ';
        if(telephone.value.length == 10)
            telephone.value = telephone.value + '-';  
    }

    function formatDateOfBirth(dateOfBirth) {
        if(dateOfBirth.value.length == 2)
            dateOfBirth.value = dateOfBirth.value + '/';
        if(dateOfBirth.value.length == 5)
            dateOfBirth.value = dateOfBirth.value + '/';        
    }
    
</script>

<div class="container-fluid login-register">
    <div class="row">
        <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0 nopadding">
            <img src="{{ URL::to('/') }}/images/banner.png" width="100%" />
        </div>
    </div>
    <div class="row login-register">
        <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
            <img class="logo-login" src="images/logo.png" />
            <h1 class="text-center login-register">Cadastre-se para enviar seu agradecimento</h1>            
        </div>
    </div>
    <div class="row login-register">
        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
            <a class="btn btn-block btn-social btn-facebook" href="{{ url('/redirect/facebook') }}"><span class="fa fa-facebook"></span>Cadastrar com Facebook</a>
            <br>
            <a class="btn btn-block btn-social btn-google" href="{{ url('/redirect/google') }}"><span class="fa fa-google-plus"></span>Cadastrar com Google+</a>
            <br><br><br>
        </div>    
        <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
            <div class="col-xs-4 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-1">
                <hr style="border-top: dotted 2px;" />
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                <span class="between-dash">ou</span>
            </div>
            <div class="col-xs-4 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-1">
                <hr style="border-top: dotted 2px;" />
            </div>
            <br><br><br>
        </div>        
        <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
            <div class="">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}
                    <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4">
                        <div class="label-register form-group{{ $errors->has('name') ? ' has-error' : '' }}">                        
                            <br><br>
                            <label for="name" class="col-lg-4 control-label label-register">NOME</label>                        
                            <input id="name" type="text" class="form-control label-register" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif                        
                        </div>
                    </div>    
                    <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4">
                        <div class="label-register form-group{{ $errors->has('surName') ? ' has-error' : '' }}">
                            <br><br>                            
                            <label for="surName" class="col-lg-4 control-label label-register">SOBRENOME</label>                        
                            <input id="surName" type="text" class="form-control label-register" name="surName" value="{{ old('surName') }}" required autofocus>
                            @if ($errors->has('surName'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('surName') }}</strong>
                                </span>
                            @endif                            
                        </div>
                    </div>
                    <div class="label-register form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                        <br><br>
                        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                            <label for="gender" class="col-md-12 control-label label-register gender-label">SEXO</label>
                            <label class="first-radio radio-inline col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
                                <input type="radio" class="form-control radio-register" id="gender" name="gender" value="masculino" @if(old('gender') === 'masculino') checked @endif required><span class="gender-text">MASCULINO</span><br><br>
                            </label>
                            <label class="radio-inline col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
                                <input type="radio" class="form-control radio-register" id="gender" name="gender" value="feminino" @if(old('gender') === 'feminino') checked @endif required><span class="gender-text">FEMININO</span><br><br>
                            </label>
                            <label class="radio-inline col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
                                <input type="radio" class="form-control radio-register" id="gender" name="gender" value="outros" @if(old('gender') === 'outros') checked @endif required><span class="gender-text">OUTROS</span>
                            </label>
                            @if ($errors->has('gender'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                        </div>    
                    </div>
                    <div class="label-register form-group{{ $errors->has('dateOfBirth') ? ' has-error' : '' }}">
                        <br><br>
                        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                            <label for="dateOfBirth" class="col-md-12 control-label label-register">DATA DE NASCIMENTO</label>
                            <input id="dateOfBirth" type="date" class="form-control label-register" name="dateOfBirth" value="{{ old('dateOfBirth') }}" required autofocus maxlength="10" onkeypress="formatDateOfBirth(this)">
                            @if ($errors->has('dateOfBirth'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('dateOfBirth') }}</strong>
                                </span>
                            @endif
                        </div>    
                    </div>
                    <div class="label-register form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                        <br><br>
                        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                            <label for="telephone" class="col-md-4 control-label label-register">TELEFONE</label>                        
                            <input id="telephone" type="text" class="form-control label-register" name="telephone" value="{{ old('telephone') }}" required autofocus maxlength="15" onkeypress="formatTelephone(this)">
                            @if ($errors->has('telephone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('telephone') }}</strong>
                                </span>
                            @endif
                        </div>    
                    </div>                    
                    <div class="label-register form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <br><br>
                        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                            <label for="email" class="col-md-4 control-label label-register">E-MAIL</label>                        
                            <input id="email" type="email" class="form-control label-register" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>    
                    </div>
                    <div class="label-register form-group{{ $errors->has('confirmEmail') ? ' has-error' : '' }}">
                        <br><br>
                        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                            <label for="confirmEmail" class="col-md-12 control-label label-register">CONFIRME SEU E-MAIL</label>                        
                            <input id="confirmEmail" type="email" class="form-control label-register" name="confirmEmail" value="{{ old('confirmEmail') }}" required autofocus>
                            @if ($errors->has('confirmEmail'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('confirmEmail') }}</strong>
                                </span>
                            @endif
                        </div>    
                    </div>
                    <div class="label-register form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                        <br><br>
                        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                            <label for="state" class="col-md-4 control-label label-register">ESTADO</label>                        
                            <select id="state" class="form-control label-register" name="state" value="{{ old('state') }}" required autofocus>                                
                            </select>    
                            @if ($errors->has('state'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('state') }}</strong>
                                </span>
                            @endif
                        </div>    
                    </div>
                    <div class="label-register form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                            <label for="city" class="col-md-4 control-label label-register">CIDADE</label>                        
                            <select id="city" class="form-control label-register" name="city" value="{{ old('city') }}" required autofocus>                                
                            </select>    
                            @if ($errors->has('city'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
                        </div>    
                    </div>
                    <div class="label-register form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                            <label for="password" class="col-md-4 control-label label-register">SENHA</label>                        
                            <input id="password" type="password" class="form-control label-register" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>    
                    </div>
                    <div class="label-register form-group{{ $errors->has('password-confirm') ? ' has-error' : '' }}">
                        <br><br>
                        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                            <label for="password-confirm" class="col-md-12 control-label label-register">CONFIRME SUA SENHA</label>                        
                            <input id="password-confirm" type="password" class="form-control label-register" name="password-confirm" required>
                            @if ($errors->has('password-confirm'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password-confirm') }}</strong>
                                </span>
                            @endif
                        </div>    
                    </div>
                    <div class="form-group">
                        <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                            <button type="submit" class="btn pink-button">ENVIAR</button>                        
                        </div>
                    </div>
                </form>
            </div>
        </div>        
    </div>
</div>
@endsection
