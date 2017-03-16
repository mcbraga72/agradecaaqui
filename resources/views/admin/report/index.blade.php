@extends('enterprise.layout')

@section('content')
<script src="http://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<script>

$(document).ready(function() {
	$(function(){
	    $.getJSON("/empresa/api/relatorios", function (result) {

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
	                    data : data
	                }
	            ]
	        };
	        
	        var buyers = document.getElementById('thanks-graph').getContext('2d');
	        
	        var chartInstance = new Chart(buyers, {
	            type: 'bar',
	            data: buyerData,
	            options: {
	            	backgroundColor: "rgba(255,153,0,1)",
					title: {
					    display: true,
					    text: 'Agradecimentos'
					}
				}	            
	        });
	    });
	});
});
</script>
<div class="container">
    <div class="row">
    	<h3>Relatórios</h3>
        <div class="col-md-8 col-md-offset-2">
            <canvas id="thanks-graph" width="1000" height="400"></canvas>
        </div>
    </div>
</div>
@endsection
