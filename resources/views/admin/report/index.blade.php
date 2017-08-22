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

		    	//CVS Reports
		    	var stateUrl = '/admin/relatorios/estado/exportar' + "/" + initialDate + "/" + finalDate;
		    	document.getElementById("stateData").setAttribute("href", stateUrl);

		    	var cityUrl = '/admin/relatorios/cidade/exportar' + "/" + initialDate + "/" + finalDate;
		    	document.getElementById("cityData").setAttribute("href", cityUrl);

		    	var genderUrl = '/admin/relatorios/genero/exportar' + "/" + initialDate + "/" + finalDate;
		    	document.getElementById("genderData").setAttribute("href", genderUrl);

		    	var maritalStatusUrl = '/admin/relatorios/estado-civil/exportar' + "/" + initialDate + "/" + finalDate;
		    	document.getElementById("maritalStatusData").setAttribute("href", maritalStatusUrl);

		    	var religionUrl = '/admin/relatorios/religiao/exportar' + "/" + initialDate + "/" + finalDate;
		    	document.getElementById("religionData").setAttribute("href", religionUrl);

		    	var educationUrl = '/admin/relatorios/escolaridade/exportar' + "/" + initialDate + "/" + finalDate;
		    	document.getElementById("educationData").setAttribute("href", educationUrl);

		    	var professionUrl = '/admin/relatorios/profissao/exportar' + "/" + initialDate + "/" + finalDate;
		    	document.getElementById("professionData").setAttribute("href", professionUrl);

		    	var incomeUrl = '/admin/relatorios/renda-familiar/exportar' + "/" + initialDate + "/" + finalDate;
		    	document.getElementById("incomeData").setAttribute("href", incomeUrl);

		    	var soccerTeamUrl = '/admin/relatorios/time-de-futebol/exportar' + "/" + initialDate + "/" + finalDate;
		    	document.getElementById("soccerTeamData").setAttribute("href", soccerTeamUrl);
		    } else {
		    	var url = '/admin/api/relatorios/cidade' + "/" + startDate + "/" + endDate;
		    	var text = 'Agradecimentos por cidade' + " - " + start + " a " + end;

		    	//CVS Reports
		    	var stateUrl = '/admin/relatorios/estado/exportar' + "/" + startDate + "/" + endDate;
		    	document.getElementById("stateData").setAttribute("href", stateUrl);
		    	
		    	var cityUrl = '/admin/relatorios/cidade/exportar' + "/" + startDate + "/" + endDate;
		    	document.getElementById("cityData").setAttribute("href", cityUrl);

		    	var genderUrl = '/admin/relatorios/genero/exportar' + "/" + startDate + "/" + endDate;
		    	document.getElementById("genderData").setAttribute("href", genderUrl);

		    	var maritalStatusUrl = '/admin/relatorios/estado-civil/exportar' + "/" + startDate + "/" + endDate;
		    	document.getElementById("maritalStatusData").setAttribute("href", maritalStatusUrl);

		    	var religionUrl = '/admin/relatorios/religiao/exportar' + "/" + startDate + "/" + endDate;
		    	document.getElementById("religionData").setAttribute("href", religionUrl);

		    	var educationUrl = '/admin/relatorios/escolaridade/exportar' + "/" + startDate + "/" + endDate;
		    	document.getElementById("educationData").setAttribute("href", educationUrl);

		    	var professionUrl = '/admin/relatorios/profissao/exportar' + "/" + startDate + "/" + endDate;
		    	document.getElementById("professionData").setAttribute("href", professionUrl);

		    	var incomeUrl = '/admin/relatorios/renda-familiar/exportar' + "/" + startDate + "/" + endDate;
		    	document.getElementById("incomeData").setAttribute("href", incomeUrl);

		    	var soccerTeamUrl = '/admin/relatorios/time-de-futebol/exportar' + "/" + startDate + "/" + endDate;
		    	document.getElementById("soccerTeamData").setAttribute("href", soccerTeamUrl);
		    }

		    $.getJSON(url, function (result) {

		        var labels = [];
		        var data = [];

		        for (var i = 0; i < result.length; i++) {
		        	if (result[i].city == '' || result[i].city == null) {
		        		result[i].city = "Não informado";
		        	}
		            labels.push(result[i].city);
		            data.push(result[i].thanks);	            
		        }

		        var buyerData = {
		            labels : labels,
		            datasets : [
		                {
		                	data : data,
		                	backgroundColor: [
	                			'rgb(255, 206, 86)',
	                			'rgb(75, 192, 192)'
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
		        	if (result[i].state == '' || result[i].state == null) {
		        		result[i].state = "Não informado";
		        	}
		            labels.push(result[i].state);
		            data.push(result[i].thanks);	            
		        }

		        var buyerData = {
		            labels : labels,
		            datasets : [
		                {
		                    data : data,
		                    backgroundColor: [
	                			'rgb(255, 99, 132)',
	                			'rgb(54, 162, 235)'
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
		        	if (result[i].gender == '' || result[i].gender == null) {
		        		result[i].gender = "Não informado";
		        	}
		            labels.push(result[i].gender);
		            data.push(result[i].thanks);	            
		        }

		        var buyerData = {
		            labels : labels,
		            datasets : [
		                {
		                    data : data,
		                    backgroundColor: [
	                		    'rgb(153, 102, 255)',
				                'rgb(255, 159, 64)'
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
		        	if (result[i].maritalStatus == '' || result[i].maritalStatus == null) {
		        		result[i].maritalStatus = "Não informado";
		        	}
		            labels.push(result[i].maritalStatus);
		            data.push(result[i].thanks);	            
		        }

		        var buyerData = {
		            labels : labels,
		            datasets : [
		                {
		                    data : data,
		                    backgroundColor: [
	                		    'rgb(153, 102, 255)',
				                'rgb(255, 159, 64)'
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
		        	if (result[i].religion == '' || result[i].religion == null) {
		        		result[i].religion = "Não informado";
		        	}
		            labels.push(result[i].religion);
		            data.push(result[i].thanks);	            
		        }

		        var buyerData = {
		            labels : labels,
		            datasets : [
		                {
		                    data : data,
		                    backgroundColor: [
	                		    'rgb(153, 102, 255)',
				                'rgb(255, 159, 64)'
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
		        	if (result[i].education == '' || result[i].education == null) {
		        		result[i].education = "Não informado";
		        	}
		            labels.push(result[i].education);
		            data.push(result[i].thanks);	            
		        }

		        var buyerData = {
		            labels : labels,
		            datasets : [
		                {
		                    data : data,
		                    backgroundColor: [
	                		    'rgb(153, 102, 255)',
				                'rgb(255, 159, 64)'
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
		        	if (result[i].profession == '' || result[i].profession == null) {
		        		result[i].profession = "Não informado";
		        	}
		            labels.push(result[i].profession);
		            data.push(result[i].thanks);	            
		        }

		        var buyerData = {
		            labels : labels,
		            datasets : [
		                {
		                    data : data,
		                    backgroundColor: [
	                		    'rgb(153, 102, 255)',
				                'rgb(255, 159, 64)'
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
		        	if (result[i].income == '' || result[i].income == null) {
		        		result[i].income = "Não informado";
		        	}
		            labels.push(result[i].income);
		            data.push(result[i].thanks);	            
		        }

		        var buyerData = {
		            labels : labels,
		            datasets : [
		                {
		                    data : data,
		                    backgroundColor: [
	                		    'rgb(153, 102, 255)',
				                'rgb(255, 159, 64)'
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
		        	if (result[i].soccerTeam == '' || result[i].soccerTeam == null) {
		        		result[i].soccerTeam = "Não informado";
		        	}
		            labels.push(result[i].soccerTeam);
		            data.push(result[i].thanks);	            
		        }

		        var buyerData = {
		            labels : labels,
		            datasets : [
		                {
		                    data : data,
		                    backgroundColor: [
	                		    'rgb(153, 102, 255)',
				                'rgb(255, 159, 64)'
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
    	<a href="" id="stateData" class="btn btn-primary"><i class="fa fa-file-excel-o fa-fw"></i>Exportar dados</a>
        <canvas id="stateThanksGraph" width="800" height="300"></canvas>
    </div>
    <div class="col-md-5 reports-box">
    	<a href="" id="cityData" class="btn btn-primary"><i class="fa fa-file-excel-o fa-fw"></i>Exportar dados</a>
        <canvas id="cityThanksGraph" width="800" height="300"></canvas>
    </div>
    <div class="col-md-5 reports-box">
    	<a href="" id="genderData" class="btn btn-primary"><i class="fa fa-file-excel-o fa-fw"></i>Exportar dados</a>
        <canvas id="genderThanksGraph" width="800" height="300"></canvas>
    </div>
    <div class="col-md-5 reports-box">
    	<a href="" id="maritalStatusData" class="btn btn-primary"><i class="fa fa-file-excel-o fa-fw"></i>Exportar dados</a>
        <canvas id="maritalStatusThanksGraph" width="800" height="300"></canvas>
    </div>
    <div class="col-md-5 reports-box">
    	<a href="" id="religionData" class="btn btn-primary"><i class="fa fa-file-excel-o fa-fw"></i>Exportar dados</a>
        <canvas id="religionThanksGraph" width="800" height="300"></canvas>
    </div>
    <div class="col-md-5 reports-box">
    	<a href="" id="educationData" class="btn btn-primary"><i class="fa fa-file-excel-o fa-fw"></i>Exportar dados</a>
        <canvas id="educationThanksGraph" width="800" height="300"></canvas>
    </div>
    <div class="col-md-5 reports-box">
    	<a href="" id="professionData" class="btn btn-primary"><i class="fa fa-file-excel-o fa-fw"></i>Exportar dados</a>
        <canvas id="professionThanksGraph" width="800" height="300"></canvas>
    </div>
    <div class="col-md-5 reports-box">
    	<a href="" id="incomeData" class="btn btn-primary"><i class="fa fa-file-excel-o fa-fw"></i>Exportar dados</a>
        <canvas id="incomeThanksGraph" width="800" height="300"></canvas>
    </div>
    <div class="col-md-5 reports-box">
    	<a href="" id="soccerTeamData" class="btn btn-primary"><i class="fa fa-file-excel-o fa-fw"></i>Exportar dados</a>
        <canvas id="soccerTeamThanksGraph" width="800" height="300"></canvas>
    </div>
</div>

@endsection
