<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
	 *
	 * Store a new payment.
	 * 
	 */
    public static function store($config)
    {
    	$payment = new Payment();
    	$payment->enterprise_id = $config['enterprise_id'];
    	$payment->paypal_id = $config['paypal_id'];
    	$payment->payment_date = $config['payment_date'];
        $payment->value = $config['value'];
    	$payment->save();

        $enterprise = Enterprise::findOrFail(Auth::guard('enterprises')->user()->id);
        $enterprise->renewal_date = $config['renewal_date'];
        $enterprise->profile = 'Premium';
        $enterprise->save();
    }
}
