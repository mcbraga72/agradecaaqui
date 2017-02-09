@extends('site.template')

@section('content')

	<div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
                <h1 class="counter-stats">Nossos números</h1>
                <div class="wrapper">
				    <div class="counter col_fourth">
				      <i class="fa fa-users fa-2x"></i>
				      <h2 class="timer count-title count-number" data-to="3214" data-speed="1500"></h2>
				       <p class="count-text ">Usuários cadastrados</p>
				    </div>
				    <div class="counter col_fourth">
				      <i class="fa fa-institution fa-2x"></i>
				      <h2 class="timer count-title count-number" data-to="421" data-speed="1500"></h2>
				      <p class="count-text ">Empresas cadastradas</p>
				    </div>
				    <div class="counter col_fourth">
				      <i class="fa fa-heart fa-2x"></i>
				      <h2 class="timer count-title count-number" data-to="9268" data-speed="1500"></h2>
				      <p class="count-text ">Agradecimentos</p>
				    </div>
				    <div class="counter col_fourth end">
				      <i class="fa fa-bar-chart fa-2x"></i>
				      <h2 class="timer count-title count-number" data-to="257192" data-speed="1500"></h2>
				      <p class="count-text ">Visualizações</p>
				    </div>
				</div>
			</div>
		</div>		
        <div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">				
                <section id="testimonies">
		            <h2 class="testimony">Veja o que andam falando de nós ...</h2>
		            <div id="story1">
		                <div class="foto"> 
		                    <img src="/images/cliente1.png" alt="Depoimentos" title="Depoimentos"/>
		                </div>
		                <div class="client-testimony"> 
		                    <h4 class="testimony"><i class="fa fa-quote-left" aria-hidden="true"></i><i> Com o agradeça aqui ficou muito fácil tornar público depoimentos sobre serviços prestados com excelência! </i><i class="fa fa-quote-right" aria-hidden="true"></i></h4><br><br>
		                    <h3 class="testimony">Renata Freitas</h3>
		                </div>
		            </div>
		            <div id="story2">
		                <div class="foto"> 
		                    <img src="images/cliente2.png" alt="Depoimentos" title="Depoimentos" />
		                </div>
		                <div class="client-testimony">
		                    <h4 class="testimony"><i class="fa fa-quote-left" aria-hidden="true"></i><i> Sempre consulto o site do agradeça aqui para verificar a reputação de empresas! </i><i class="fa fa-quote-right" aria-hidden="true"></i></h4><br><br>
		                    <h3 class="testimony">Daniel Medeiros</h3>
		                </div>
		            </div>
		            <div id="story3">
		                <div class="foto"> 
		                    <img src="images/cliente3.png" alt="Depoimentos" title="Depoimentos" />
		                </div>
		                <div class="client-testimony"> 
		                    <h4 class="testimony"><i class="fa fa-quote-left" aria-hidden="true"></i><i> Parabéns pela iniciativa! Temos que criar o hábito de também elogiar serviços que atendem ou superam nossas expectativas como clientes. </i><i class="fa fa-quote-right" aria-hidden="true"></i></h4><br><br>
		                    <h3 class="testimony">Juliana Batista</h3>
		                </div>
		            </div><br><br>
				</section>
            </div>
        </div>
    </div>

@endsection