<?php

namespace App\Policies;

use App\User;
use App\EnterpriseThanks;
use Illuminate\Auth\Access\HandlesAuthorization;

class EnterpriseThanksPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the enterpriseThanks.
     *
     * @param  \App\User  $user
     * @param  \App\EnterpriseThanks  $enterpriseThanks
     * @return mixed
     */
    public function view(User $user, EnterpriseThanks $enterpriseThanks)
    {
        return true;
    }

    /**
     * Determine whether the user can create enterpriseThanks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;    
    }

    /**
     * Determine whether the user can update the enterpriseThanks.
     *
     * @param  \App\User  $user
     * @param  \App\EnterpriseThanks  $enterpriseThanks
     * @return mixed
     */
    public function update(User $user, EnterpriseThanks $enterpriseThanks)
    {
        return $user->id === $enterpriseThanks->user_id;
    }

    /**
     * Determine whether the user can delete the enterpriseThanks.
     *
     * @param  \App\User  $user
     * @param  \App\EnterpriseThanks  $enterpriseThanks
     * @return mixed
     */
    public function delete(User $user, EnterpriseThanks $enterpriseThanks)
    {
        return $user->id === $enterpriseThanks->user_id;
    }
}
