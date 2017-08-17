<?php

return [
	// Sandbox
	'client_id' =>'AcWlJha0KqALuglxX-tRvitbkC15BAxXbtV4yWVNyUdGVMHMACtlRzwdSWQX9a_aJIfaz-ou93kFt5ZG',
	'secret' => 'EFdI0o9QK_bm1JKjgxwZMSVpThVWMiUmgY26CAoyIJpn4tORWAJafIgFriundCd3nXYsbbt2o933meDb',
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
