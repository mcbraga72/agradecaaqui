<?php

namespace App\Models;

use App\Models\Enterprise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

	/**
     * Enable soft deletes to the category model.
     *
     * @var array
     */	
	protected $dates = [
        'expires_at',
        'deleted_at'
    ];

    /**
     * Get the enterprise that owns the payment.
     * 
     * @return Enterprise
     */
	public function enterprise() 
	{
		return $this->belongsTo(Enterprise::class);
	}
}
