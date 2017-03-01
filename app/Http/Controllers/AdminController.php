<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	/**
	 * 
	 * Constructor for EnterpriseAreaController class
	 * 
	 */
	public function __construct()
	{
		$this->middleware('admin.area');
	}

    /**
	 * Login page
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('admin.login');
	}

	/**
	 * Dashboard page
	 *
	 * @return Response
	 */
	public function dashboard()
	{
		return view('admin.dashboard');
	}

	/**
	 *
	 * Shows edit profile's page
	 * 
	 * @return Response
	 * 
	 */
    public function editProfile()
    {
    	return view('admin.profile', ['admin' => Admin::findOrFail($id)]);
    }

    /**
	 * Update enterprise's data
	 * 
	 */
    public function updateProfile(AdminRequest $request)
    {
    	$enterprise = new Admin();

    	$enterprise->name = $request->name;
    	$enterprise->email = $request->email;        
    	
    	$enterprise->save();

    	return view('admin.dashboard');
    }
}
