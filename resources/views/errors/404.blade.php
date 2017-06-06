@extends('site.template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0 nopadding">
                <img src="{{ URL::to('/') }}/images/banner.png" width="100%" />
            </div>
        </div>    
        <div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
                <img class="logo-login" src="images/logo.png" />
                <h1 class="support erro404-title">Erro 404! Página não encontrada.</h1>
                <div style="height: 100px;">
                	<h2 class="support erro404-content">Clique <a href="{{ URL::to('/') }}">aqui</a> para acessar nossa página inicial.</h2>
                </div>
			</div>
		</div>		        
    </div>

@endsection