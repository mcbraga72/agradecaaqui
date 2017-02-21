<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/app';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);        
    }

    /**
     *
     * Where to redirect user after login
     * 
     */
    /*public function redirectPath()
    {
        $type = Session::get('type');

        if ($type === 'userThanks') {
            $this->redirectTo = '/app/agradecimento-usuario/criar';
        } else if ($type === 'enterpriseThanks') {
            $this->redirectTo = '/app/agradecimento-empresa/criar';
        } else {            
            $this->redirectTo = '/app';
        }
    }*/   
}
