@extends('site.template')

@section('content')

<div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
                <section id="depoimentos">
		            <h2>Veja o que andam falando de nós ...</h2>
		            <div id="relato1">
		                <div class="foto"> 
		                    <img src="/images/cliente1.png" alt="Depoimentos" title="Depoimentos"/>
		                </div>
		                <div class="depoimento"> 
		                    <h4><i class="fa fa-quote-left" aria-hidden="true"></i><i> Com o agradeça aqui ficou muito fácil tornar público depoimentos sobre serviços prestados com excelência! </i><i class="fa fa-quote-right" aria-hidden="true"></i></h4><br><br>
		                    <h3>Renata Freitas</h3>
		                </div>
		            </div>
		            <div id="relato2">
		                <div class="foto"> 
		                    <img src="images/cliente2.png" alt="Depoimentos" title="Depoimentos" />
		                </div>
		                <div class="depoimento">
		                    <h4><i class="fa fa-quote-left" aria-hidden="true"></i><i> Sempre consulto o site do agradeça aqui para verificar a reputação de empresas! </i><i class="fa fa-quote-right" aria-hidden="true"></i></h4><br><br>
		                    <h3>Daniel Medeiros</h3>
		                </div>
		            </div>
		            <div id="relato3">
		                <div class="foto"> 
		                    <img src="images/cliente3.png" alt="Depoimentos" title="Depoimentos" />
		                </div>
		                <div class="depoimento"> 
		                    <h4><i class="fa fa-quote-left" aria-hidden="true"></i><i> Parabéns pela iniciativa! Temos que criar o hábito de também elogiar serviços que atendem ou superam nossas expectativas como clientes. </i><i class="fa fa-quote-right" aria-hidden="true"></i></h4><br><br>
		                    <h3>Juliana Batista</h3>
		                </div>
		            </div>
				</section>
            </div>
        </div>
    </div>

@endsection