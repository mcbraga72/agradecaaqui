@extends('enterprise.layout')

@section('content')
<script src="http://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<script>

$(document).ready(function() {
	$(function(){
	    $.getJSON("/empresa/api/relatorios/estado", function (result) {

	        var labels = [];
	        var data = [];

	        for (var i = 0; i < result.length; i++) {
	            labels.push(result[i].state);
	            data.push(result[i].thanks);	            
	        }

	        var buyerData = {
	            labels : labels,
	            datasets : [
	                {
	                    data : data,
	                    backgroundColor: [
                			'rgba(255, 99, 132, 0.2)',
                			'rgba(54, 162, 235, 0.2)'
			            ]
	                }
	            ]
	        };
	        
	        var buyers = document.getElementById('stateThanksGraph').getContext('2d');
	        
	        var chartInstance = new Chart(buyers, {
	            type: 'pie',
	            data: buyerData,
	            options: {
	            	title: {
					    display: true,
					    text: 'Agradecimentos por estado'
					}
				}	            
	        });
	    });
	});

	$(function(){
	    $.getJSON("/empresa/api/relatorios/cidade", function (result) {

	        var labels = [];
	        var data = [];

	        for (var i = 0; i < result.length; i++) {
	            labels.push(result[i].city);
	            data.push(result[i].thanks);	            
	        }

	        var buyerData = {
	            labels : labels,
	            datasets : [
	                {
	                	data : data,
	                	backgroundColor: [
                			'rgba(255, 206, 86, 0.2)',
                			'rgba(75, 192, 192, 0.2)'
			            ]
	                }
	            ]
	        };
	        
	        var buyers = document.getElementById('cityThanksGraph').getContext('2d');
	        
	        var chartInstance = new Chart(buyers, {
	            type: 'pie',
	            data: buyerData,
	            options: {
	            	title: {
					    display: true,
					    text: 'Agradecimentos por cidade'
					}
				}	            
	        });
	    });
	});

	$(function(){
	    $.getJSON("/empresa/api/relatorios/sexo", function (result) {

	        var labels = [];
	        var data = [];

	        for (var i = 0; i < result.length; i++) {
	            labels.push(result[i].gender);
	            data.push(result[i].thanks);	            
	        }

	        var buyerData = {
	            labels : labels,
	            datasets : [
	                {
	                    data : data,
	                    backgroundColor: [
                		    'rgba(153, 102, 255, 0.2)',
			                'rgba(255, 159, 64, 0.2)'
			            ]
	                }
	            ]
	        };
	        
	        var buyers = document.getElementById('genderThanksGraph').getContext('2d');
	        
	        var chartInstance = new Chart(buyers, {
	            type: 'pie',
	            data: buyerData,
	            options: {
	            	title: {
					    display: true,
					    text: 'Agradecimentos por sexo'
					}
				}	            
	        });
	    });
	});
});
</script>
<div class="row" style="margin-left: 1%;">
	<p style="margin-top: 2%;">Relatórios</p>
	<div class="col-md-11">
		<div class="panel panel-default">
	    	<div class="panel-heading">Selecione os filtros abaixo para gerar seu relatório personalizado.</div>
	    	<div class="panel-body reports-fields">	    		
	    		<select name="reportType" id="reportType" class="col-md-3" style="margin-right: 2%;">
	    			<option value="">Selecione o tipo do relatório</option>
	    			<option value="state">Estado</option>
	    		</select>
	    		<input type="text" name="start" id="start" placeholder="Data inicial" class="col-md-3" style="margin-right: 2%;">
	    		<input type="text" name="end" id="end" placeholder="Data final" class="col-md-3" style="margin-right: 2%;">
	    		<button type="button" class="btn btn-primary col-md-2" data-toggle="modal" data-target="#customReportModal" onclick="generateCustomReport()">Gerar Relatório</button>
	    	</div>
		</div>
	</div>	
    <div class="col-md-5 reports-box">
        <canvas id="stateThanksGraph" width="800" height="300"></canvas>
    </div>
    <div class="col-md-5 reports-box">
        <canvas id="cityThanksGraph" width="800" height="300"></canvas>
    </div>
    <div class="col-md-5 reports-box">
        <canvas id="genderThanksGraph" width="800" height="300"></canvas>
    </div>
</div>

<!-- Custom Report Modal -->
<script>

	function generateCustomReport() {
		var type = document.getElementById('reportType').value;
		var start = document.getElementById('start').value;
		var end = document.getElementById('end').value;

	    $.getJSON("/empresa/api/relatorio/" + type + "/" + start + "/" + end, function (result) {

	        var labels = [];
	        var data = [];

	        for (var i = 0; i < result.length; i++) {
	            labels.push(result[i].state);
	            data.push(result[i].thanks);	            
	        }

	        var buyerData = {
	            labels : labels,
	            datasets : [
	                {
	                    data : data,
	                    backgroundColor: [
                			'rgba(255, 99, 132, 0.2)',
                			'rgba(54, 162, 235, 0.2)'
			            ]
	                }
	            ]
	        };
	        
	        var buyers = document.getElementById('customReportGraph').getContext('2d');
	        
	        var chartInstance = new Chart(buyers, {
	            type: 'pie',
	            data: buyerData,
	            options: {
	            	title: {
					    display: true,
					    text: 'Agradecimentos por estado'
					}
				}	            
	        });
	    });
	}    

</script>
<div class="modal fade" id="customReportModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-name" id="myModalLabel">Relatório Personalizado</h4>
            </div>
            <div class="modal-body">
            	<div class="reports-box">
					<canvas id="customReportGraph" width="80%" height="400"></canvas>
				</div>                
            </div>
        </div>
    </div>
</div>

@endsection
