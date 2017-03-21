@extends('app.template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 home">
            <img class="logo-login" src="{{asset('images/logo.png')}}"" />
            <h1 class="support">Compartilhar agradecimento</h1>            
        </div>          
    </div>    
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
            @foreach($enterpriseThanks as $enterpriseThank)
                <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-1 col-lg-3 col-xl-2 col-xl-offset-1 thanks-box">
                    <p class="thanks-title">{{ $enterpriseThank->enterprise->name }}</p>
                    <p class="thaks-content">{{ strip_tags($enterpriseThank->content) }}</p>
                    <img class="user-photo"src="/{{ $enterpriseThank->enterprise->logo }}" alt="Agradecimento" title="Agradecimento" /><br><br>
                    <button type="button" class="btn social-network facebook-button"><i class="fa fa-2x fa-facebook" aria-hidden="true"></i></button>
                    <button type="button" class="btn social-network twitter-button"><i class="fa fa-2x fa-twitter" aria-hidden="true"></i></button>
                    <button type="button" class="btn social-network google-button"><i class="fa fa-2x fa-google-plus" aria-hidden="true"></i></button>
                    <button type="button" class="btn social-network whatsapp-button"><i class="fa fa-2x fa-whatsapp" aria-hidden="true"></i></button>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
