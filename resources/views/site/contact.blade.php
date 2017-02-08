@extends('site.template')

@section('content')

<div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopadding">
	            <section class="contato">
		    		<div class="contatos" itemscope itemtype="http://schema.org/Person">
			        	<h2>Fale conosco</h2>
		                <h3>Para falar conosco, utilize um dos canais de atendimento abaixo ou envie uma mensagem utilizando o formul&aacute;rio ao lado.</h5>
			        	<p itemprop="address"><i class="fa fa-map-marker"></i>  Rua Manoel Coelho, 500 - Sala 1206. Centro - São Caetano do Sul/SP</p><br>
			        	<p itemprop="telephone"><i class="fa fa-phone"></i>  (11) 2376-2157</p><br>
			        	<p itemprop="telephone"><i class="fa fa-whatsapp"></i>  (11) 97672-2791</p><br>
			        	<p itemprop="email"><i class="fa fa-envelope"></i><a href="mailto:contato@agradecaaqui.com.br">  contato@agradecaaqui.com.br</a></p><br>
	            	</div>
		    		<div class="formulario">
				        <input type="text" id="nome" placeholder="Digite seu nome">
				        <input type="email" id="email" placeholder="Digite seu e-mail">
				        <textarea id="assunto" placeholder="Digite sua mensagem"></textarea>
				        <input type="submit" id="enviar" value="Enviar mensagem">
				    </div>
				</section>
				<section id="mapa">
	                <img src="{{ URL::to('/') }}/images/mapa.png" />
				</section>
            </div>
        </div>
    </div>

@endsection