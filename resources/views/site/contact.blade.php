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
	    		<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3 contact-form">
	    			<h1>Fale conosco</h1>
	                <h2>Para falar conosco, envie uma mensagem utilizando o formul&aacute;rio abaixo.</h2>		            
		            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3 contact-form">
			        	<input type="text" id="nome" placeholder="Digite seu nome">
			    	</div>			        	
			        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3 contact-form">
			        	<input type="email" id="email" placeholder="Digite seu e-mail">
			    	</div>			        	
			        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3 contact-form">
			        	<textarea id="assunto" placeholder="Digite sua mensagem"></textarea>
			    	</div>			        	
			        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 col-xl-6 col-xl-offset-3 contact-form">
			        	<input type="submit" id="enviar" value="Enviar mensagem">
			    	</div>
				</div>    
			</section>				
        </div>
    </div>
</div>

@endsection