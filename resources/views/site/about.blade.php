@extends('site.template')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0 nopadding">
            <img src="{{ URL::to('/') }}/images/banner.png" width="100%" />
        </div>
    </div>
	<div class="row">
        <div class="col-xs-4 col-xs-offset4- col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
            <section class="enterprise">            	
          	    <div class="about-text">
			    	<h1 class="about">Venha para o lado do bem!</h1>
                    <p class="history">Oi, pessoal! Nossa história começou num bate-papo entre amigos, desses que a gente joga conversa fora sem nenhuma pretensão.</p> 
                    <p class="history">Nos demos conta das inúmeras pessoas, situações, produtos, serviços e empresas que poderíamos agradecer.</p>
                    <p class="history">E hoje estamos aqui \o/  \o/  \o/</p>
                    <p class="history">Acreditamos que podemos transformar o ato de agradecer num hábito. A gente sabe que nem tudo é bom, mas por que falar das coisas ruins?</p>
                    <p class="history">Pense nisso, pense positivo e ...</p>
                    <p class="hashtag">#agradecaaqui</p>
			    </div>
            </section>
        </div>
    </div>    
</div>

@endsection