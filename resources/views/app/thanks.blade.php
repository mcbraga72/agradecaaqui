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
	        	@forelse($allThanks as $allThank)
	        		<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thanks-title">Meus agradecimentos</p>
	                    @if($allThank->logo != 'people')
	                    	<a href="{{ route('enterprise-thanks.show', $allThank->hash) }}"><img class="heart" src="images/heart.png" /></a>
	                    @else
	                    	<a href="{{ route('user-thanks.show', $allThank->hash) }}"><img class="heart" src="images/heart.png" /></a>
	                    @endif
	                    <p class="thaks-content">{{ $allThank->content }}</p>
	                    @if($allThank->logo != 'people')
	                    	<img class="user-photo" src="{{ asset($allThank->logo) }}" alt="Agradecimento" title="Agradecimento" />
	                    @else
	                    	<img class="user-photo" src="{{ asset('images/people.png') }}" alt="Agradecimento" title="Agradecimento" />	                    	
	                    @endif
	                    <span class="user-name">{{ $allThank->name }}</span>
	                </div>    				
				@empty
    				<div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-3 col-md-offset-1 col-lg-3 col-lg-offset-1 thanks-box">
	                    <p class="thaks-content">Você ainda não fez nenhum agradecimento em nossa plataforma.</p>
	                </div>	                
	                <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 show-more">
						<img class="enterprise-logo" src="{{asset('images/plus.png')}}"" alt="Mostrar mais" title="Mostrar mais" />
	                </div>
				@endforelse				
	        </div>    
	    </div>
    </div>	
@endsection