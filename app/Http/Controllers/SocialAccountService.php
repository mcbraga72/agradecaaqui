<?php

namespace App\Http\Controllers;

use App\Models\SocialAccount;
use App\Models\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }

    public function getUser(ProviderUser $providerUser, $provider)
    {
        $user = User::whereEmail($providerUser->getEmail())->first();
        dd($user);

        if ($user) {            
            $account = SocialAccount::whereProvider($provider)
            ->whereProviderUserId($providerUser->getId())
            ->first();
            if(!$account) {
                $account->user()->associate($user);
                $account->save();
            }    
            return $user;
        } else {
            return null;
        }   
    }

    public function createSocialAccount(User $user, $id)
    {
        $account = SocialAccount::whereProvider('facebook')
            ->whereProviderUserId($id)
            ->first();

        if(!$account) {
            $account = new SocialAccount([
                'provider_user_id' => $id,
                'provider' => 'facebook'
            ]);

            $account->user()->associate($user);
            $account->save();
        }
    }
}
