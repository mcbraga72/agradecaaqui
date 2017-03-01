<?php

namespace App\Models;

use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $guard = 'admins';

    /**
	 * Send the password reset notification.
	 *
	 * @param  string  $token
	 * @return void
	 */
	public function sendPasswordResetNotification($token)
	{
	    $this->notify(new AdminResetPasswordNotification($token));
	}
}
