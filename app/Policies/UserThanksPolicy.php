<?php

namespace App\Policies;

use App\User;
use App\UserThanks;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserThanksPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the userThanks.
     *
     * @param  \App\User  $user
     * @param  \App\UserThanks  $userThanks
     * @return mixed
     */
    public function view(User $user, UserThanks $userThanks)
    {
        return true;
    }

    /**
     * Determine whether the user can create userThanks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the userThanks.
     *
     * @param  \App\User  $user
     * @param  \App\UserThanks  $userThanks
     * @return mixed
     */
    public function update(User $user, UserThanks $userThanks)
    {
        return $user->id === $userThanks->user_id;
    }

    /**
     * Determine whether the user can delete the userThanks.
     *
     * @param  \App\User  $user
     * @param  \App\UserThanks  $userThanks
     * @return mixed
     */
    public function delete(User $user, UserThanks $userThanks)
    {
        return $user->id === $userThanks->user_id;
    }
}
