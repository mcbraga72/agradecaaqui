@extends('admin.layout')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<script>
	function formatDate(date) {
        if(date.value.length == 2)
            date.value = date.value + '/';
        if(date.value.length == 5)
            date.value = date.value + '/';        
    }

    $(document).ready(function() {
		var date = new Date();
		var month = date.getMonth() + 1;
		var day = date.getDate();

		var timeStampInitialDate = new Date().setDate(date.getDate()-30);
		var initialDateUnformatted = new Date(timeStampInitialDate);
		var initialMonth = initialDateUnformatted.getMonth() + 1;
		var initialDate = initialDateUnformatted.getFullYear() + '-' + (initialMonth < 10 ? '0' : '') + initialMonth + '-' + (day < 10 ? '0' : '') + day;		
		var initialDateText = (day < 10 ? '0' : '') + day + "/" + (initialMonth < 10 ? '0' : '') + initialMonth + "/" + initialDateUnformatted.getFullYear();

		var finalDate = date.getFullYear() + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
		var finalDateText = (day < 10 ? '0' : '') + day + "/" + (month < 10 ? '0' : '') + month + "/" + date.getFullYear();
			
		var start = document.getElementById('start').value;
		var startDay = start.substring(0, 2);
		var startMonth = start.substring(3, 5);
		var startYear = start.substring(6, 10);
		var startDate = startYear + "-" + startMonth + "-" + startDay;

		var end = document.getElementById('end').value;
		var endDay = end.substring(0, 2);
		var endMonth = end.substring(3, 5);
		var endYear = end.substring(6, 10);
		var endDate = endYear + "-" + endMonth + "-" + endDay;

		$(function(){
			if(start == '' && end == '') {
		    	var url = '/admin/api/relatorios/cidade' + "/" + initialDate + "/" + finalDate;
		    	var text = 'Agradecimentos por cidade' + " - " + initialDateText + " a " + finalDateText;
		    } else {
		    	var url = '/admin/api/relatorios/cidade' + "/" + startDate + "/" + endDate;
		    	var text = 'Agradecimentos por cidade' + " - " + start + " a " + end;
		    }

		    $.getJSON(url, function (result) {

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
						    text: text
						}
					}	            
		        });
		    });
		});

		$(function(){
		    if(start == '' && end == '') {
		    	var url = '/admin/api/relatorios/estado' + "/" + initialDate + "/" + finalDate;
		    	var text = 'Agradecimentos por estado' + " - " + initialDateText + " a " + finalDateText;
		    } else {
		    	var url = '/admin/api/relatorios/estado' + "/" + startDate + "/" + endDate;
		    	var text = 'Agradecimentos por estado' + " - " + start + " a " + end;
		    }

		    $.getJSON(url, function (result) {

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
						    text: text
						}
					}	            
		        });
		    });
		});

		$(function(){
		    if(start == '' && end == '') {
		    	var url = '/admin/api/relatorios/genero' + "/" + initialDate + "/" + finalDate;
		    	var text = 'Agradecimentos por gênero' + " - " + initialDateText + " a " + finalDateText;
		    } else {
		    	var url = '/admin/api/relatorios/genero' + "/" + startDate + "/" + endDate;
		    	var text = 'Agradecimentos por gênero' + " - " + start + " a " + end;
		    }

		    $.getJSON(url, function (result) {

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
						    text: text
						}
					}	            
		        });
		    });
		});

		$(function(){
		    if(start == '' && end == '') {
		    	var url = '/admin/api/relatorios/estado-civil' + "/" + initialDate + "/" + finalDate;
		    	var text = 'Agradecimentos por estado civil' + " - " + initialDateText + " a " + finalDateText;
		    } else {
		    	var url = '/admin/api/relatorios/estado-civil' + "/" + startDate + "/" + endDate;
		    	var text = 'Agradecimentos por estado civil' + " - " + start + " a " + end;
		    }

		    $.getJSON(url, function (result) {

		        var labels = [];
		        var data = [];

		        for (var i = 0; i < result.length; i++) {
		            labels.push(result[i].maritalStatus);
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
		        
		        var buyers = document.getElementById('maritalStatusThanksGraph').getContext('2d');
		        
		        var chartInstance = new Chart(buyers, {
		            type: 'pie',
		            data: buyerData,
		            options: {
		            	title: {
						    display: true,
						    text: text
						}
					}	            
		        });
		    });
		});

		$(function(){
		    if(start == '' && end == '') {
		    	var url = '/admin/api/relatorios/religiao' + "/" + initialDate + "/" + finalDate;
		    	var text = 'Agradecimentos por religião' + " - " + initialDateText + " a " + finalDateText;
		    } else {
		    	var url = '/admin/api/relatorios/religiao' + "/" + startDate + "/" + endDate;
		    	var text = 'Agradecimentos por religião' + " - " + start + " a " + end;
		    }

		    $.getJSON(url, function (result) {

		        var labels = [];
		        var data = [];

		        for (var i = 0; i < result.length; i++) {
		            labels.push(result[i].religion);
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
		        
		        var buyers = document.getElementById('religionThanksGraph').getContext('2d');
		        
		        var chartInstance = new Chart(buyers, {
		            type: 'pie',
		            data: buyerData,
		            options: {
		            	title: {
						    display: true,
						    text: text
						}
					}	            
		        });
		    });
		});

		$(function(){
		  	if(start == '' && end == '') {
		    	var url = '/admin/api/relatorios/escolaridade' + "/" + initialDate + "/" + finalDate;
		    	var text = 'Agradecimentos por escolaridade' + " - " + initialDateText + " a " + finalDateText;
		    } else {
		    	var url = '/admin/api/relatorios/escolaridade' + "/" + startDate + "/" + endDate;
		    	var text = 'Agradecimentos por escolaridade' + " - " + start + " a " + end;
		    }

		    $.getJSON(url, function (result) {

		        var labels = [];
		        var data = [];

		        for (var i = 0; i < result.length; i++) {
		            labels.push(result[i].education);
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
		        
		        var buyers = document.getElementById('educationThanksGraph').getContext('2d');
		        
		        var chartInstance = new Chart(buyers, {
		            type: 'pie',
		            data: buyerData,
		            options: {
		            	title: {
						    display: true,
						    text: text
						}
					}	            
		        });
		    });
		});

		$(function(){
		  	if(start == '' && end == '') {
		    	var url = '/admin/api/relatorios/profissao' + "/" + initialDate + "/" + finalDate;
		    	var text = 'Agradecimentos por profissão' + " - " + initialDateText + " a " + finalDateText;
		    } else {
		    	var url = '/admin/api/relatorios/profissao' + "/" + startDate + "/" + endDate;
		    	var text = 'Agradecimentos por profissão' + " - " + start + " a " + end;
		    }

		    $.getJSON(url, function (result) {

		        var labels = [];
		        var data = [];

		        for (var i = 0; i < result.length; i++) {
		            labels.push(result[i].profession);
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
		        
		        var buyers = document.getElementById('professionThanksGraph').getContext('2d');
		        
		        var chartInstance = new Chart(buyers, {
		            type: 'pie',
		            data: buyerData,
		            options: {
		            	title: {
						    display: true,
						    text: text
						}
					}	            
		        });
		    });
		});

		$(function(){
		  	if(start == '' && end == '') {
		    	var url = '/admin/api/relatorios/renda-familiar' + "/" + initialDate + "/" + finalDate;
		    	var text = 'Agradecimentos por renda familiar' + " - " + initialDateText + " a " + finalDateText;
		    } else {
		    	var url = '/admin/api/relatorios/renda-familiar' + "/" + startDate + "/" + endDate;
		    	var text = 'Agradecimentos por renda familiar' + " - " + start + " a " + end;
		    }

		    $.getJSON(url, function (result) {

		        var labels = [];
		        var data = [];

		        for (var i = 0; i < result.length; i++) {
		            labels.push(result[i].income);
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
		        
		        var buyers = document.getElementById('incomeThanksGraph').getContext('2d');
		        
		        var chartInstance = new Chart(buyers, {
		            type: 'pie',
		            data: buyerData,
		            options: {
		            	title: {
						    display: true,
						    text: text
						}
					}	            
		        });
		    });
		});

		$(function(){
		  	if(start == '' && end == '') {
		    	var url = '/admin/api/relatorios/time-de-futebol' + "/" + initialDate + "/" + finalDate;
		    	var text = 'Agradecimentos por time de futebol' + " - " + initialDateText + " a " + finalDateText;
		    } else {
		    	var url = '/admin/api/relatorios/time-de-futebol' + "/" + startDate + "/" + endDate;
		    	var text = 'Agradecimentos por time de futebol' + " - " + start + " a " + end;
		    }

		    $.getJSON(url, function (result) {

		        var labels = [];
		        var data = [];

		        for (var i = 0; i < result.length; i++) {
		            labels.push(result[i].soccerTeam);
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
		        
		        var buyers = document.getElementById('soccerTeamThanksGraph').getContext('2d');
		        
		        var chartInstance = new Chart(buyers, {
		            type: 'pie',
		            data: buyerData,
		            options: {
		            	title: {
						    display: true,
						    text: text
						}
					}	            
		        });
		    });
		});
	});
</script>
<div class="row" style="margin-left: 1%;">
	<h3 style="margin-top: 2%;">Relatórios</h3>
	<div class="col-md-11">
		<div class="panel panel-default">
	    	<div class="panel-heading">Selecione os filtros abaixo para gerar seu relatório personalizado.</div>
	    	<div class="panel-body reports-fields">	    		
	    		<input type="text" name="start" id="start" placeholder="Data inicial" class="col-md-3" style="margin-right: 2%;" maxlength="10" onkeypress="formatDate(this)">
	    		<input type="text" name="end" id="end" placeholder="Data final" class="col-md-3" style="margin-right: 2%;" maxlength="10" onkeypress="formatDate(this)">
	    		<button type="button" class="btn btn-primary col-md-2" onclick="window.location.reload()">Gerar Relatório</button>
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
    <div class="col-md-5 reports-box">
        <canvas id="maritalStatusThanksGraph" width="800" height="300"></canvas>
    </div>
    <div class="col-md-5 reports-box">
        <canvas id="religionThanksGraph" width="800" height="300"></canvas>
    </div>
    <div class="col-md-5 reports-box">
        <canvas id="educationThanksGraph" width="800" height="300"></canvas>
    </div>
    <div class="col-md-5 reports-box">
        <canvas id="professionThanksGraph" width="800" height="300"></canvas>
    </div>
    <div class="col-md-5 reports-box">
        <canvas id="incomeThanksGraph" width="800" height="300"></canvas>
    </div>
    <div class="col-md-5 reports-box">
        <canvas id="soccerTeamThanksGraph" width="800" height="300"></canvas>
    </div>
</div>

@endsection
