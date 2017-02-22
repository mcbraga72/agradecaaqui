@extends('app.template')

@section('content')
	<div class="container-fluid">
		<div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 home">
                <img class="logo-login" src="{{asset('images/logo.png')}}"" />
                <h1 class="support">Comentários</h1>			
				<form class="form-horizontal" role="form" method="POST" action="{{ url('busca') }}">
	            {{ csrf_field() }}
					<div class="form-group{{ $errors->has('busca') ? ' has-error' : '' }}">
		                <br><br>
		                <div class="col-md-6">
		                    <input id="busca" type="busca" class="form-control search" name="busca" value="{{ old('busca') }}" placeholder="Pesquisar por" required autofocus>
		                    @if ($errors->has('busca'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('busca') }}</strong>
		                        </span>
		                    @endif
		                </div>
		            </div>
		            <div class="form-group">
		                <div class="col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
		                    <button type="submit" class="btn pink-button">Pesquisar</button>	                    
		                </div>
		            </div>
		        </form>
	        </div>	        
		</div>    
		<div class="row">
			<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
	        	@forelse($enterpriseThanks as $enterpriseThank)
    				<h2>{{ $enterpriseThank->content }}</h2>
				@empty
    				<!--<h2>Não existe nenhum agradecimento cadastrado em nossa base de dados!</h2>-->    				
					<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thanks-title">Lorem Ipsum</p>
	                    <img class="heart" src="{{asset('images/heart.png')}}"" />
	                    <p class="thaks-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	                    <img class="user-photo"src="{{asset('images/cliente1.png')}}"" alt="Agradecimento" title="Agradecimento" />
	                    <span class="user-name">Camila Veiga</span>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thanks-title">Lorem Ipsum</p>
	                    <img class="heart" src="{{asset('images/heart.png')}}"" />
	                    <p class="thaks-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	                    <img class="user-photo"src="{{asset('images/cliente1.png')}}"" alt="Agradecimento" title="Agradecimento" />
	                    <span class="user-name">Camila Veiga</span>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thanks-title">Lorem Ipsum</p>
	                    <img class="heart" src="{{asset('images/heart.png')}}"" />
	                    <p class="thaks-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	                    <img class="user-photo"src="{{asset('images/cliente1.png')}}"" alt="Agradecimento" title="Agradecimento" />
	                    <span class="user-name">Camila Veiga</span>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thanks-title">Lorem Ipsum</p>
	                    <img class="heart" src="{{asset('images/heart.png')}}"" />
	                    <p class="thaks-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	                    <img class="user-photo"src="{{asset('images/cliente1.png')}}"" alt="Agradecimento" title="Agradecimento" />
	                    <span class="user-name">Camila Veiga</span>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thanks-title">Lorem Ipsum</p>
	                    <img class="heart" src="{{asset('images/heart.png')}}"" />
	                    <p class="thaks-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	                    <img class="user-photo"src="{{asset('images/cliente1.png')}}"" alt="Agradecimento" title="Agradecimento" />
	                    <span class="user-name">Camila Veiga</span>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thanks-title">Lorem Ipsum</p>
	                    <img class="heart" src="{{asset('images/heart.png')}}"" />
	                    <p class="thaks-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	                    <img class="user-photo"src="{{asset('images/cliente1.png')}}"" alt="Agradecimento" title="Agradecimento" />
	                    <span class="user-name">Camila Veiga</span>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thanks-title">Lorem Ipsum</p>
	                    <img class="heart" src="{{asset('images/heart.png')}}"" />
	                    <p class="thaks-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	                    <img class="user-photo"src="{{asset('images/cliente1.png')}}"" alt="Agradecimento" title="Agradecimento" />
	                    <span class="user-name">Camila Veiga</span>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thanks-title">Lorem Ipsum</p>
	                    <img class="heart" src="{{asset('images/heart.png')}}"" />
	                    <p class="thaks-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	                    <img class="user-photo"src="{{asset('images/cliente1.png')}}"" alt="Agradecimento" title="Agradecimento" />
	                    <span class="user-name">Camila Veiga</span>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thanks-title">Lorem Ipsum</p>
	                    <img class="heart" src="{{asset('images/heart.png')}}"" />
	                    <p class="thaks-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
	                    <img class="user-photo"src="{{asset('images/cliente1.png')}}"" alt="Agradecimento" title="Agradecimento" />
	                    <span class="user-name">Camila Veiga</span>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 show-more">
						<img class="plus" src="{{asset('images/plus.png')}}"" alt="Mostrar mais" title="Mostrar mais" />
	                </div>
				@endforelse				
	        </div>    
	    </div>
    </div>	
@endsection