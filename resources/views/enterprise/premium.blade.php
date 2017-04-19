@extends('enterprise.layout')

@section('content')
<div class="row" style="margin-left: 1%;">
	  <p style="margin-top: 2%;">Acesso Premium</p>
	  <div class="col-md-11">
		    <div class="panel panel-default">
	    	    <div class="panel-heading premium-access">Veja as vantagens que o acesso premium oferece</div>
            <div class="panel-body reports-fields">
                <ul class="list-inline">
                    <li class="advantages"><i class="fa fa-bar-chart fa-4x fa-fw"></i><h1>Relatórios Plus</h1></a></li>
                    <li class="advantages"><i class="fa fa-dashboard fa-4x fa-fw"></i><h1>Dashboard Plus</h1></a></li>
                    <li class="advantages"><i class="fa fa-line-chart fa-4x fa-fw"></i><h1>Estatísticas</h1></a></li>
                </ul>
            </div>
		    </div>
        <button type="button" class="btn btn-primary button-premium">QUERO ASSINAR!</button>
	  </div>
</div>
@endsection
