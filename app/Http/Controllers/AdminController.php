<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
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
}
