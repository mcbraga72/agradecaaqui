@extends('site.template')

@section('content')
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
        <div class="col-xs-4 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-2 col-md-offset-5 col-lg-2 col-lg-offset-5">
            <a class="btn btn-block btn-social btn-facebook" href="{{ url('/redirect/facebook') }}"><span class="fa fa-facebook"></span>Cadastrar com Facebook</a>
            <br>
            <a class="btn btn-block btn-social btn-google" href="{{ url('/redirect/google') }}"><span class="fa fa-google-plus"></span>Cadastrar com Google+</a>
            <br><br><br>
        </div>    
        <div class="col-xs-4 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">                
            <div class="col-xs-4 col-sm-4 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-1">
                <hr style="border-top: dotted 2px;" />
            </div>
            <div class="col-xs-4 col-sm-4 col-md-1 col-lg-1">
                <span class="between-dash">ou</span>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-1">
                <hr style="border-top: dotted 2px;" />
            </div>
            <br><br><br>        
            <div class="">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <br><br>
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
                        <div class="form-group{{ $errors->has('surName') ? ' has-error' : '' }}">
                            <br><br>
                            <label for="surName" class="col-md-4 control-label">Sobrenome</label>
                            <div class="col-md-6">
                                <input id="surName" type="text" class="form-control" name="surName" value="{{ old('surName') }}" required autofocus>
                                @if ($errors->has('surName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('surName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('dateOfBirth') ? ' has-error' : '' }}">
                            <br><br>
                            <label for="dateOfBirth" class="col-md-4 control-label">Nome</label>
                            <div class="col-md-6">
                                <input id="dateOfBirth" type="date" class="form-control" name="dateOfBirth" value="{{ old('dateOfBirth') }}" required autofocus>
                                @if ($errors->has('dateOfBirth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dateOfBirth') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                            <br><br>
                            <label for="telephone" class="col-md-4 control-label">Telefone</label>
                            <div class="col-md-6">
                                <input id="telephone" type="text" class="form-control" name="telephone" value="{{ old('telephone') }}" required autofocus>
                                @if ($errors->has('telephone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telephone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('cellphone') ? ' has-error' : '' }}">
                            <br><br>
                            <label for="cellphone" class="col-md-4 control-label">Celular</label>
                            <div class="col-md-6">
                                <input id="cellphone" type="text" class="form-control" name="cellphone" value="{{ old('cellphone') }}" required autofocus>
                                @if ($errors->has('cellphone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cellphone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <br><br>
                            <label for="email" class="col-md-4 control-label">E-mail</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('confirmEmail') ? ' has-error' : '' }}">
                            <br><br>
                            <label for="confirmEmail" class="col-md-4 control-label">Confirme seu e-mail</label>
                            <div class="col-md-6">
                                <input id="confirmEmail" type="email" class="form-control" name="confirmEmail" value="{{ old('confirmEmail') }}" required autofocus>
                                @if ($errors->has('confirmEmail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('confirmEmail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            <br><br>
                            <label for="state" class="col-md-4 control-label">Estado</label>
                            <div class="col-md-6">
                                <select id="state" class="form-control" name="state" value="{{ old('state') }}" required autofocus>
                                    <option value="">Selecione o estado</option>
                                </select>    
                                @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <br><br>
                            <label for="city" class="col-md-4 control-label">Cidade</label>
                            <div class="col-md-6">
                                <select id="city" class="form-control" name="city" value="{{ old('city') }}" required autofocus>
                                    <option value="">Selecione a cidade</option>
                                </select>    
                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Senha</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('confirmPassword') ? ' has-error' : '' }}">
                            <label for="confirmPassword" class="col-md-4 control-label">Confirme sua senha</label>
                            <div class="col-md-6">
                                <input id="confirmPassword" type="password" class="form-control" name="confirmPassword" required>
                                @if ($errors->has('confirmPassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('confirmPassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn pink-button">ENVIAR</button>                        
                            </div>
                        </div>
                    </form>
                </div>
            </div>            
        </div>        
    </div>
</div>
@endsection
