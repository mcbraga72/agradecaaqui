<?php

namespace App\Models;

use App\Models\Category;
use App\Models\EnterpriseThanks;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enterprise extends Model
{
    use SoftDeletes;

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
		return $this->belongsTo('Category');
	}

	/**
     * Get the enterprises thanks that belongs to the enterprise.
     * 
     * @return EnterpriseThanks[]
     */
	public function enterpriseThanks() 
	{
		return $this->hasMany('EnterpriseThanks');
	}
}
