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
    	'thanksDateTime'
    ];

    /**
     * Get the user that sent the user thanks.
     * 
     * @return User
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
