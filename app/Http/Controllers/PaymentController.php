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
    	$payment->date = $config['date'];
    	$payment->value = $config['value'];
    	$payment->save();    	
    }
}
