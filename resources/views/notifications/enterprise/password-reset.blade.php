<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>Agradeça Aqui</title>
        
    </head>
    <body>
    	<style>
	        p {
	        	font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
	            font-size: 15px;
	            line-height: 1.4;
	            color: #999;
	            text-align: center;
	            margin: 0 0 10px;
	        }

	        a, a:hover, a:visited, a:link, a:active {
	        	font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
	        	font-size: 18px;
	        	height: 40px;
	        	width: 140px;
	        	background-color: #3097D1;
	        	color: #FFF;
	        	border: 1px solid #3097D1;
	        	border-radius: 5px;
	        	padding-top: 15px;
	        	padding-left: 32px;
	        	text-decoration: none;
	        	display: block;
	        	margin-left: auto;
	        	margin-right: auto;
	        }
	        img {
	        	display: block;
	        	margin-left: auto;
	        	margin-right: auto;
	        	margin-top: 5%;
	        }
	    </style>
        <div class="row">
            <div class="col-xl-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                <img src="{{ URL::to('/') }}/images/logoEmail.png" /><br><br><br>
			    <p>Você recebeu este e-mail devido a uma solicatação de alteração de senha feita no site Agradeça Aqui.</p>
			    <p>Caso você não tenha feito esta solicitação, por favor, desconsidere este e-mail.</p> 
			    <br><br><br>
			    <a href="{{ URL::to('/') }}/empresa/alterar-senha/{{ $token }}">Alterar Senha</a><br><br><br><br>
			    <p>Obrigado por utilizar nossa plataforma!</p><br><br>
			    <p>Atenciosamente,</p>
			    <p style="margin-bottom: 5%;">Equipe de atendimento - Agradeça Aqui</p>
            </div>
        </div>
	</body>
</html>