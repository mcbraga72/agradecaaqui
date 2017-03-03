<?php

namespace App\Models;

use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
	use Notifiable;
    use SoftDeletes;

	/**
     * The guard for Enterprise.
     *
     * @var string
     */
    protected $guard = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Enable soft deletes to the enterprise model.
     *
     * @var array
     */
    protected $dates = [
    	'expires_at',
    	'deleted_at'
    ];

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
