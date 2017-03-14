<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Laravel\Socialite\Facades;

class SocialAuthController extends Controller
{
    	/**
	 * Redirect to Facebook
	 * @return [type] [description]
	 */
    public function redirectFacebook()
    {
        return Socialite::driver('facebook')->redirect();   
    }   

    /**
     * Callback From Facebook
     * @param  SocialAccountService $service
     * @return Response
     */
    public function callbackFacebook(SocialAccountService $service)
    {        
        $providerUser = Socialite::driver('facebook')->user();
        return view('site.register')->with('providerUser', $providerUser);

//$user = $service->createOrGetUser(Socialite::driver('facebook')->user());
        //auth()->login($user);
        //return redirect()->to('/app');
    }

    /**
     * Redirect to Google
     * @return [type] [description]
     */
    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();   
    }   

    /**
     * Callback From Google
     * @param  SocialAccountService $service [description]
     * @return Response
     */
    public function callbackGoogle(SocialAccountService $service)
    {
        $providerUser = Socialite::driver('facebook')->user();
        return view('site.register')->with('providerUser', $providerUser);

        /*$user = $service->createOrGetUser(Socialite::driver('google')->user());
        auth()->login($user);
        return redirect()->to('/app');*/
    }
}
