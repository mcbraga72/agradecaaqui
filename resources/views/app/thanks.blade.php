@extends('app.template')

@section('content')
	<div class="container-fluid">
		<div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 home">
                <img class="logo-login" src="{{asset('images/logo.png')}}"" />
                <h1 class="support">Comentários</h1>			
				<form class="form-horizontal" role="form" method="POST" action="{{ url('/app/agradecimentos/busca') }}">
	            {{ csrf_field() }}
					<div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">
		                <br><br>
		                <div class="col-md-6">
		                    <input type="text" class="form-control search" id="search" name="search" placeholder="Pesquisar por" required autofocus>
		                    @if ($errors->has('search'))
		                        <span class="help-block">
		                            <strong>{{ $errors->first('search') }}</strong>
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
	        	@forelse($data['enterprisesThanks'] as $enterprisesThank)
	        		<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-1 col-lg-3 col-xl-2 col-xl-offset-1 thanks-box">
	                    <p class="thanks-title">{{ $enterprisesThank->name }}</p>
	                    <a href="{{ route('enterprise-thanks.show', $enterprisesThank->hash) }}"><img class="heart" src="{{ asset('images/heart.png') }}" /></a>
	                    <p class="thaks-content">{{ strip_tags($enterprisesThank->content) }}</p>
	                    <img class="user-photo" src="{{ asset($enterprisesThank->logo) }}" alt="Agradecimento" title="Agradecimento" />	                    
	                </div>    				
				@empty
    				<div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 col-xl-6 col-xl-offset-3 thanks-box">
	                    <img class="heart" src="images/heart.png" />
	                    <p class="thaks-content">Você ainda não fez nenhum agradecimento em nossa plataforma.</p>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 show-more">
						<img class="plus" src="images/plus.png" alt="Mostrar mais" title="Mostrar mais" />
	                </div>
				@endforelse
				@forelse($data['usersThanks'] as $usersThank)
	        		<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-1 col-lg-3 col-xl-2 col-xl-offset-1 thanks-box">
	                    <p class="thanks-title">{{ $usersThank->receiptName }}</p>
	                    <a href="{{ route('user-thanks.show', $usersThank->hash) }}"><img class="heart" src="{{ asset('images/heart.png') }}" /></a>
	                    <p class="thaks-content">{{ strip_tags($usersThank->content) }}</p>
	                    <img class="user-photo" src="{{ asset('images/people.png') }}" alt="Agradecimento" title="Agradecimento" />
	                </div>    				
				@empty
    				<div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3 col-xl-6 col-xl-offset-3 thanks-box">
	                    <img class="heart" src="images/heart.png" />
	                    <p class="thaks-content">Você ainda não fez nenhum agradecimento em nossa plataforma.</p>
	                </div>
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 show-more">
						<img class="plus" src="images/plus.png" alt="Mostrar mais" title="Mostrar mais" />
	                </div>
				@endforelse
	        </div>    
	    </div>
    </div>	
@endsection