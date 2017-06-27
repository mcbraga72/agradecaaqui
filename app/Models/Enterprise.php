<?php

namespace App\Models;

use App\Models\Category;
use App\Models\EnterpriseThanks;
use App\Notifications\EnterpriseResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Enterprise extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The guard for Enterprise.
     *
     * @var string
     */
    protected $guard = 'enterprises';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'contact', 'email', 'telephone', 'address', 'neighborhood', 'city', 'state', 'cpf', 'cnpj', 'status', 'password'
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
     * Get the category that has the enterprise.
     * 
     * @return Category
     */
	public function category() 
	{
		return $this->belongsTo(Category::class);
	}

	/**
     * Get the enterprises thanks that belongs to the enterprise.
     * 
     * @return EnterpriseThanks[]
     */
	public function enterpriseThanks() 
	{
		return $this->hasMany(EnterpriseThanks::class);
	}

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
            $this->notify(new EnterpriseResetPasswordNotification($token));
    }
}
