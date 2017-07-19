@extends('enterprise.layout')

@section('content')
<div class="row" style="margin-left: 1%;">
	  <h4 style="margin-top: 2%;">Acesso Premium</h4>
	  <div class="col-md-11">
		    <div class="panel panel-default">
	    	    <div class="panel-heading premium-access">Veja as vantagens que o acesso premium oferece</div>
            <div class="panel-body reports-fields">
                <div class="col-md-2 col-md-offset-3 plan-data-box">
                    <div class="col-md-12 plan-data-box-header">
                        <h1 class="plan-name">Basic</h1>
                    </div>
                    <div class="col-md-12 plan-data-box-body">
                        <h1 class="features">Ver agradecimentos</h1>
                        <hr class="dotted">
                        <h1 class="features">Responder agradecimentos</h1>
                        <hr class="dotted">
                        <h1 class="features">Dashboard básico</h1>
                        <hr class="dotted">
                        <h1 class="price-free">GRÁTIS</h1>
                    </div>
                </div>
                <div class="col-md-2 col-md-offset-2 plan-data-box">
                    <div class="col-md-12 plan-data-box-header">
                        <h1 class="plan-name">Premium</h1>
                    </div>
                    <div class="col-md-12 plan-data-box-body">
                        <h1 class="features">Ver agradecimentos</h1>
                        <hr class="dotted">
                        <h1 class="features">Responder agradecimentos</h1>
                        <hr class="dotted">
                        <h1 class="features">Dashboard plus</h1>
                        <hr class="dotted">
                        <h1 class="features">Relatórios</h1>
                        <hr class="dotted">
                        <h1 class="features">Extração de dados</h1>
                        <hr class="dotted">
                        <h1 class="features">Identidade Agradeça Aqui</h1>
                        <hr class="dotted">
                        <h1 class="features">Parceiro Agradeça Aqui</h1>
                        <hr class="dotted">
                        <h1 class="features">Suporte técnico</h1>
                        <hr class="dotted">
                        <h1 class="price">R$ 49,90 / mês</h1>
                        <h1 class="price">ou</h1>
                        <h1 class="price">R$ 499,00 / ano</h1><h2 class="price">(economize 2 meses)</h1>
                    </div>
                </div>
            </div>
		    </div>
        <a href="{{ URL::to('/') }}/empresa/assinatura-premium" class="btn btn-primary button-premium">QUERO ASSINAR!</a>
	  </div>
</div>
@endsection
