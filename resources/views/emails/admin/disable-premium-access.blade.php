<!DOCTYPE html>
<html lang="pt-br">
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

	        img {
	        	display: block;
	        	margin-left: auto;
	        	margin-right: auto;
	        	margin-top: 5%;
	        }
	    </style>
        <div class="row">
            <div class="col-xl-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
				<img src="{{ URL::to('/') }}/images/logoEmail.png" /><br><br>
				<p>Prezado administrador, a empresa {{ $enterprise }} teve seu acesso premium bloqueado por falta de pagamento.</p> 
				<p>Mensagem automática gerada pelo sistema Agradeça Aqui</p>
			</div>
        </div>
	</body>
</html>