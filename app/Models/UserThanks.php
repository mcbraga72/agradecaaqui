<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserThanks extends Model
{
    use SoftDeletes;

    /**
     * Enable soft deletes to the user thanks model.
     *
     * @var array
     */
    protected $dates = [
    	'expires_at',
    	'deleted_at',
    	'date'
    ];

    /**
     * Get the user that received the user thanks.
     * 
     * @return User
     */
    public function receipt()
    {
    	return $this->belongsTo('User', 'user_id', 'receipt');
    }

    /**
     * Get the user that sent the user thanks.
     * 
     * @return User
     */
    public function sender()
    {
    	return $this->belongsTo('User', 'user_id', 'sender');
    }
}
