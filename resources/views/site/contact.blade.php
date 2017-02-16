@extends('site.template')

@section('content')

<div class="container-fluid">
	<div class="row">
        <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0 nopadding">
            <img src="{{ URL::to('/') }}/images/banner.png" width="100%" />
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopadding">
            <section class="contato">
	    		<div class="formulario col-xs-4 col-xs-offset4- col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
	    			<h1>Fale conosco</h1>
	                <h2>Para falar conosco, envie uma mensagem utilizando o formul&aacute;rio abaixo.</h2>
			        <input type="text" id="nome" placeholder="Digite seu nome">
			        <input type="email" id="email" placeholder="Digite seu e-mail">
			        <textarea id="assunto" placeholder="Digite sua mensagem"></textarea>
			        <input type="submit" id="enviar" value="Enviar mensagem">
			    </div>
			</section>				
        </div>
    </div>
</div>

@endsection