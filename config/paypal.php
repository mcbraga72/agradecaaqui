<?php

return [
	// Sandbox
	'client_id' =>'AVc4QxpdLph6UjkfvL3q15jF1IBxQBd-ZlGAFbTwhw1NIvDuRYkRwgMw9UXpEQg7I0owNNZn6UEeycZP',
	'secret' => 'EN7qf2mvI_f8isRvCuiYVVg8hRa5w1KXoDVPEXOYclWYZ0dwAtELdmRgs28sS_dFDpPPIjZg-lTH0AAD',
	// Production (Live)
	//'client_id' =>'AQkysL0A7hcLpfsuLRmjn9ecaRVs4K-ZFWBjm9kZbzowjQ2twenTdrQYb_AbpDBHhrHwDypcoT9q5VnZ',
	//'secret' => 'EFJoxsKnmN-knufnPWm6eC-S-WAAqFyRnml3LkKtgvMZQ00VzRFYAHZjhFGNzdytteY7xudzw-OsNkE4',
	'settings' => [
		'mode' => 'sandbox', // Available options: 'sandbox' or 'live'.
		//'mode' => 'live', // Available options: 'sandbox' or 'live'.
		'http.ConnectionTimeOut' => 1000,
		'log.LogEnabled' => true,
		'log.FileName' => storage_path() . '/logs/paypal.log',
		'log.LogLevel' => 'FINE' // Available options: 'FINE', 'INFO', 'WARN' or 'ERROR'. Logging is most verbose in the 'FINE' level and decreases as you proceed towards ERROR.
	]
];
