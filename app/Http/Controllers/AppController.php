<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class AppController extends Controller
{
	/**
	 * Login page
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('app.login');
	}

    /**
	 * Dashboard page
	 *
	 * @return Response
	 */
	public function dashboard()
	{
		return view('app.dashboard');
	}

	/**
	 *
	 * Edit user data.
	 *
	 * @param int $id
	 *
	 * @return Response
	 * 
	 */
	public function edit()
    {
    	return view('app.user.profile', ['user' => User::findOrFail(Auth::user()->id)]);
    }

    /**
	 *
	 * Update user's data.
	 *
	 * @param int $id
	 *
	 * @return Response
	 * 
	 */
    public function update(UserRequest $request, $id)
    {
    	$user = User::find($id);

    	$user->name = $request->name;

    	$user->save();
    	
    	return view('app.dashboard');
    }
}
