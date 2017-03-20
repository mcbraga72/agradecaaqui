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
    <div class="col-md-5 col-md-offset-1">
        <canvas id="stateThanksGraph" width="1000" height="400"></canvas>
    </div>
    <div class="col-md-5 col-md-offset-1">
        <canvas id="cityThanksGraph" width="1000" height="400"></canvas>
    </div>
    <div class="col-md-5 col-md-offset-1" style="margin-top: 5%;">
        <canvas id="genderThanksGraph" width="1000" height="400"></canvas>
    </div>
</div>

@endsection
