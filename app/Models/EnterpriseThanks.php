<?php

namespace App\Models;

use App\Models\Enterprise;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnterpriseThanks extends Model
{
    use SoftDeletes;

    /**
     * Enable soft deletes to the enterprise thanks model.
     *
     * @var array
     */
    protected $dates = [
    	'expires_at',
    	'deleted_at',
        'thanksDateTime'
    ];

    /**
     * Get the enterprise that received the enterprise thanks.
     * 
     * @return Enterprise
     */
    public function enterprise()
    {
    	return $this->belongsTo(Enterprise::class);
    }

    /**
     * Get the user that made the enterprise thanks.
     * 
     * @return User
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
