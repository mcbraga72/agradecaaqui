<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Enterprise;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;
use Validator;

class PaypalController extends Controller
{
    private $_api_context;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //parent::__construct();
        
        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    
    /**
     * Show the application paywith paypalpage.
     *
     * @return \Illuminate\Http\Response
     */
    public function payWithPaypal()
    {
        return view('paypal.payment');
    }
    
    /**
     * Store a details of payment with paypal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPaymentWithpaypal(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        
        $item_1 = new Item();
        $item_1->setName('Item 1') /** item name **/
            ->setCurrency('BRL')
            ->setQuantity(1)
            ->setPrice($request->get('amount')); /** unit price **/
        
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        
        $amount = new Amount();
        $amount->setCurrency('BRL')
            ->setTotal($request->get('amount'));
        
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');
        
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status')) /** Specify return URL **/
            ->setCancelUrl(URL::route('payment.status'));
        
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
            /** dd($payment->create($this->_api_context));exit; **/
        
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Falha de comunicação com o servidor da Paypal.');
                return Redirect::route('paywithpaypal');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                \Session::put('error','Erro desconhecido. Por favor entre em contato com o administrador do sistema.');
                return Redirect::route('paywithpaypal');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }
        
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        
        if(isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        
        \Session::put('error','Erro desconhecido. Por favor entre em contato com o administrador do sistema.');
        
        return Redirect::route('paywithpaypal');
    }

    /**
     * Get payment status.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Falha ao efetuar o pagamento. Por favor tente fazer o pagamento novamente.');
            return Redirect::route('paywithpaypal');
        }
        
        $payment = Payment::get($payment_id, $this->_api_context);
        
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') { 
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            \Session::put('success','Pagamento realizado com successo!');

            // Store payment data in database
            
            $date = new \DateTime();
            $paymentDate = $date->format('Y-m-d');

            $currentRenewalDate = Auth::guard('enterprises')->user()->renewal_date;
            
            // Check if it's monthly plan or anual plan
            if($result->transactions[0]->amount->total > 200) {
                $interval = new \DateInterval('P1Y');

                if(PaypalController::checlIfRenewalDateNeedsToBeChanged()) {
                    $renewalDate = $date->add($interval)->format('Y-m-d'); //data atual + 1 ano
                } else {
                    $renewalDate = $currentRenewalDate->add($interval)->format('Y-m-d'); // data de renovação + 1 ano
                }
            } else {
                $interval = new \DateInterval('P1M');

                if(PaypalController::checlIfRenewalDateNeedsToBeChanged()) {
                    $renewalDate = $date->add($interval)->format('Y-m-d'); //data atual + 1 mês
                } else {
                    $renewalDate = $currentRenewalDate->add($interval)->format('Y-m-d'); // data de renovação + 1 mês
                }
            }
            
            $config = [
                'enterprise_id' => Auth::guard('enterprises')->user()->id,
                'paypal_id' => $result->getId(),
                'value' => $result->transactions[0]->amount->total,
                'payment_date' => $paymentDate,
                'renewal_date' => $renewalDate,
            ];

            PaymentController::store($config);
            
            return Redirect::route('paywithpaypal');
        }
        
        \Session::put('error','Falha ao efetuar o pagamento. Por favor tente fazer o pagamento novamente.');
        
        return Redirect::route('paywithpaypal');
    }

    /**
     * Check if the renewal_date's day needs to be changed.
     *
     * @return boolean
     */
    private static function checlIfRenewalDateNeedsToBeChanged()
    {
        $date = new \DateTime();
        $paymentDate = $date->format('Y-m-d');

        $currentRenewalDate = Auth::guard('enterprises')->user()->renewal_date;

        if($currentRenewalDate < $paymentDate) {
            return true;
        } else {
            return false;
        }
    }
}
