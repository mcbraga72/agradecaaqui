<?php

return [
	'client_id' =>'agradecaaquicontato@gmail.com',
	'secret' => 'agradeca2017',
	'settings' => [
		'mode' => 'sandbox',
		'http.ConnectionTimeOut' => 1000,
		'log.LogEnabled' => true,
		'log.FileName' => storage_path() . '/logs/paypal.log',
		'log.LogLevel' => 'FINE'
	]
];