@extends('site.template')

@section('content')

<div class="container-fluid">
	<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <section class="enterprise">            	
            	<div class="about-image">
            	    <img src="images/mission-bg.png" />
			    </div>
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
    <div class="row team-background">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <section class="about-team">
            	<h1 class="team-title">Nossa equipe</h1>
        		<div class="col-team">
			    	<div class="team"> 
                    	<img src="images/colaborador1.png" alt="Equipe" title="Equipe" />
                    	<i class="fa fa-linkedin fa-2x contacts" aria-hidden="true"></i>
						<i class="fa fa-facebook fa-2x contacts" aria-hidden="true"></i>
						<i class="fa fa-envelope fa-2x contacts" aria-hidden="true"></i>
                    	<div class="team-description">
                    		<p class="name">Cátia Mota</p>
                    		<p class="job">Diretora de Marketing</p>
                    		<p class="job-description">Lorem ipsum dolor sit amet consectetur adipiscing elit in pulvinar amet consectetur amet adipiscing elit.</p>
						</div>
                	</div>
			    </div>
			    <div class="col-team">
			      	<div class="team"> 
                    	<img src="images/colaborador2.png" alt="Equipe" title="Equipe" />
                    	<i class="fa fa-linkedin fa-2x contacts" aria-hidden="true"></i>
						<i class="fa fa-facebook fa-2x contacts" aria-hidden="true"></i>
						<i class="fa fa-envelope fa-2x contacts" aria-hidden="true"></i>
                    	<div class="team-description">
                    		<p class="name">Vítor Rodrigues</p>
                    		<p class="job">Diretor</p>
                    		<p class="job-description">Lorem ipsum dolor sit amet consectetur adipiscing elit in pulvinar amet consectetur amet adipiscing elit.</p>
						</div>
                	</div>
			    </div>
			    <div class="col-team">
			      	<div class="team"> 
                    	<img src="images/colaborador3.png" alt="Equipe" title="Equipe" />
                    	<i class="fa fa-linkedin fa-2x contacts" aria-hidden="true"></i>
						<i class="fa fa-facebook fa-2x contacts" aria-hidden="true"></i>
						<i class="fa fa-envelope fa-2x contacts" aria-hidden="true"></i>
                    	<div class="team-description">
                    		<p class="name">Gustavo Dantas</p>
                    		<p class="job">Diretor de Tecnologia</p>
                    		<p class="job-description">Lorem ipsum dolor sit amet consectetur adipiscing elit in pulvinar amet consectetur amet adipiscing elit.</p>
						</div>
                	</div>
			    </div>			    
            </section>            
        </div>
    </div>
</div>

@endsection