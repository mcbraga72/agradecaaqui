<?php

namespace App\Policies;

use App\User;
use App\Enterprise;
use Illuminate\Auth\Access\HandlesAuthorization;

class EnterprisePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the enterprise.
     *
     * @param  \App\User  $user
     * @param  \App\Enterprise  $enterprise
     * @return mixed
     */
    public function view(User $user, Enterprise $enterprise)
    {
        return true;
    }

    /**
     * Determine whether the user can create enterprises.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can approve enterprises pending registrations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function approvePendingRegistration(User $user)
    {
        if($user->role === 'Admin'){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the enterprise.
     *
     * @param  \App\User  $user
     * @param  \App\Enterprise  $enterprise
     * @return mixed
     */
    public function update(User $user, Enterprise $enterprise)
    {
        if($user->role === 'Admin'){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the enterprise.
     *
     * @param  \App\User  $user
     * @param  \App\Enterprise  $enterprise
     * @return mixed
     */
    public function delete(User $user, Enterprise $enterprise)
    {
        if($user->role === 'Admin'){
            return true;
        }
        return false;
    }
}
