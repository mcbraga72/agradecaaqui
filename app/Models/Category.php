<?php

namespace App\Models;

use App\Models\Enterprise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
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
     * Get the enterprises that belongs to the category.
     * 
     * @return  Enterprise[]
     */
	public function enterprise() 
	{
		return $this->hasMany('Enterprise');
	}
}
