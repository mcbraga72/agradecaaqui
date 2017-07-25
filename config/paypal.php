<?php

return [
	'client_id' =>'AVc4QxpdLph6UjkfvL3q15jF1IBxQBd-ZlGAFbTwhw1NIvDuRYkRwgMw9UXpEQg7I0owNNZn6UEeycZP',
	'secret' => 'EN7qf2mvI_f8isRvCuiYVVg8hRa5w1KXoDVPEXOYclWYZ0dwAtELdmRgs28sS_dFDpPPIjZg-lTH0AAD',
	'settings' => [
		'mode' => 'sandbox',
		'http.ConnectionTimeOut' => 1000,
		'log.LogEnabled' => true,
		'log.FileName' => storage_path() . '/logs/paypal.log',
		'log.LogLevel' => 'FINE'
	]
];