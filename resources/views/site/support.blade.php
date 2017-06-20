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
                <h1 class="support">Veja abaixo os nossos parceiros:</h1>
                <div style="height: 400px;">
                	
                </div>
			</div>
		</div>		        
    </div>

@endsection