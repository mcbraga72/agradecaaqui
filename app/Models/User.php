<?php

namespace App\Models;

use App\Models\UserThanks;
use App\Models\EnterpriseThanks;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surName', 'gender', 'dateOfBirth', 'telephone', 'city', 'state', 'email', 'password', 'role'
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
     * Enable soft deletes to the user model.
     *
     * @var array
     */
    protected $dates = [
        'expires_at',
        'deleted_at'
    ];

    /**
     * Get the enterprise thanks the user sent
     * 
     * @return EnterpriseThanks[]
     */
    public function enterpriseThanks()
    {
        return $this->hasMany(EnterpriseThanks::class);
    }

    /**
     * Get the user thanks the user sent
     * 
     * @return UserThanks[]
     */
    public function userThanks()
    {
        return $this->hasMany(UserThanks::class);
    }
}
