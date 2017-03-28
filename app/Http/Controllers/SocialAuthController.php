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
        /*$user = $service->createOrGetUser(Socialite::driver('facebook')->user());
        auth()->login($user);
        return redirect()->to('/app');*/

        $providerUser = Socialite::driver('facebook')->user();
        $user = $service->getUser($providerUser);
        
        if (!is_null($user)) {
            auth()->login($user);
            return redirect()->to('/app');
        } else {            
            return view('site.register')->with('providerUser', $providerUser);
        }
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
        /*$user = $service->createOrGetUser(Socialite::driver('google')->user());
        auth()->login($user);
        return redirect()->to('/app');*/

        $providerUser = Socialite::driver('facebook')->user();
        $user = $service->getUser($providerUser);
        
        if (!is_null($user)) {
            auth()->login($user);
            return redirect()->to('/app');
        } else {            
            return view('site.register')->with('providerUser', $providerUser);
        }
    }
}
