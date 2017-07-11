<?php

namespace App\Http\Controllers;

use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades;
use Socialite;

class SocialAuthController extends Controller
{
    /**
	 * Redirect to Facebook
	 * @return [type] [description]
	 */
    public function redirectFacebook()
    {
        return Socialite::driver('facebook')->fields([
            'first_name', 'last_name', 'email', 'gender', 'birthday', 'location'
        ])->scopes([
            'email', 'user_birthday', 'user_location'
        ])->redirect();
    }

    /**
     * Callback From Facebook
     * @param  SocialAccountService $service
     * @return Response
     */
    public function callbackFacebook(SocialAccountService $service)
    {
        $providerUser = Socialite::driver('facebook')->fields([
            'first_name', 'last_name', 'email', 'gender', 'birthday', 'location'
        ])->user();

        $user = $service->getUser($providerUser, 'facebook');
        
        if (!is_null($user)) {
            auth()->login($user);
            return redirect()->to('/app');
        } else {            
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);
            
            $user = User::create([
                'email' => $providerUser->getEmail(),
                'name' => $providerUser->user['first_name'],
                'gender' => $providerUser->user['gender'],
                'photo' => $providerUser->avatar,
                'password' => str_random(10)
            ]);

            $account->user()->associate($user);
            $account->save();

            auth()->login($user);
            return redirect()->to('/app');
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
        $providerUser = Socialite::driver('google')->user();
        $user = $service->getUser($providerUser, 'google');
        
        if (!is_null($user)) {
            auth()->login($user);
            return redirect()->to('/app');
        } else {            
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'google'
            ]);
            
            $user = User::create([
                'email' => $providerUser->getEmail(),
                'name' => $providerUser->getName(),
                'photo' => $providerUser->avatar,
                'password' => str_random(10)
            ]);

            $account->user()->associate($user);
            $account->save();

            auth()->login($user);
            return redirect()->to('/app');
        }
    }
}
