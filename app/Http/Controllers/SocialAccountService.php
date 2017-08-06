<?php

namespace App\Http\Controllers;

use App\Models\SocialAccount;
use App\Models\User;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Laravel\Socialite\Facades;
use Socialite;

class SocialAccountService
{
    public function getUser(ProviderUser $providerUser, $provider)
    {
        $user = User::whereEmail($providerUser->getEmail())->withTrashed()->first();
        
        if ($user) {            
            $account = SocialAccount::whereProvider($provider)
            ->whereProviderUserId($providerUser->getId())
            ->first();
            if(!$account) {
                $account = new SocialAccount([
                    'provider_user_id' => $providerUser->getId(),
                    'provider' => $provider
                ]);

                $account->user()->associate($user);
                $account->save();
            }    
            return $user;
        } else {
            return null;
        }   
    }

    public function createSocialAccount(User $user)
    {
        $providerUser = Socialite::driver('facebook')->user();

        $account = SocialAccount::whereProvider('facebook')
            ->whereProviderUserId($id)
            ->first();

        if(!$account) {
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            $account->user()->associate($user);
            $account->save();
        }
    }
}
