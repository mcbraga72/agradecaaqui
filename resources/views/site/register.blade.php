@extends('site.template')

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
            <img class="logo-login" src="{{ URL::to('/') }}/images/logo.png" />
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
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                {{ csrf_field() }}
                @if (isset($providerUser))
                    <input type="hidden" name="id" value="{{ $providerUser->getId() }}">                    
                @endif    
                <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                    <div class="label-register form-group{{ $errors->has('name') ? ' has-error' : '' }}">                        
                        <br><br>
                        <label for="name" class="col-lg-4 control-label label-register">NOME</label>                        
                        @if (isset($providerUser))
                            <input id="name" type="text" class="form-control label-register" name="name" value="{{ $providerUser->getName() }}" required autofocus>
                        @else
                            <input id="name" type="text" class="form-control label-register" name="name" value="{{ old('name') }}" required autofocus>
                        @endif    
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif                        
                    </div>
                </div>    
                <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
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
                <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                    <div class="label-register form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                        <br><br>
                        <label for="gender" class="col-md-4 control-label label-register">SEXO</label>
                        <select id="gender" class="form-control label-register" name="gender" value="{{ old('gender') }}" required autofocus>
                            <option value="">Selecione o sexo</option>
                            <option value="Feminino" @if(old('gender') === 'Feminino') selected @endif>Feminino</option>
                            <option value="Masculino" @if(old('gender') === 'Masculino') selected @endif>Masculino</option>
                            <option value="Outros" @if(old('gender') === 'Outros') selected @endif>Outros</option>
                        </select>    
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
                        @if (isset($providerUser))
                            <input id="email" type="email" class="form-control label-register" name="email" value="{{ $providerUser->getEmail() }}" required autofocus>
                        @else
                            <input id="email" type="email" class="form-control label-register" name="email" value="{{ old('email') }}" required autofocus>
                        @endif        
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
                        @if (isset($providerUser))
                            <input id="confirmEmail" type="email" class="form-control label-register" name="confirmEmail" value="{{ $providerUser->getEmail() }}" required autofocus>
                        @else
                            <input id="confirmEmail" type="email" class="form-control label-register" name="confirmEmail" value="{{ old('confirmEmail') }}" required autofocus>
                        @endif    
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
                        <select id="state" class="form-control label-register" name="state" value="{{ old('state') }}" v-model="state" v-on:change="onChange" required autofocus>
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
                </div>
                <div class="label-register form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                    <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
                        <label for="city" class="col-md-4 control-label label-register">CIDADE</label>                        
                        <select id="city" class="form-control label-register" name="city" value="{{ old('city') }}" v-model="city" required autofocus>
                            <option v-for="option in options" v-bind:value="option">@{{ option }}</option>
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
                        <button type="submit" class="btn pink-button">Enviar</button>                        
                    </div>
                </div>
            </form>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/vue.resource/0.9.3/vue-resource.min.js"></script>
            <script type="text/javascript" src="/js/site-enterprises.js"></script>            
        </div>        
    </div>
</div>
@endsection
