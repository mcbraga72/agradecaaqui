<?php

namespace App\Http\Controllers;

use App\Models\Enterprise;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AppController extends Controller
{
	/**
	 * Dashboard page
	 *
	 * @return Response
	 */
	public function dashboard()
	{
		return view('app.index');
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
	 * @param Request $request
	 * @param int $id
	 *
	 * @return Response
	 * 
	 */
    public function update(UserRequest $request, $id)
    {
    	$user = User::find($id);

    	$user->name = $request->name;
    	$user->surName = $request->surName;
        $user->gender = $request->gender;
        $user->dateOfBirth = $request->dateOfBirth;
        $user->telephone = $request->telephone;
        $user->cellphone = $request->cellphone;
        $user->city = $request->city;
        $user->state = $request->state;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);

    	$user->save();
    	
    	return view('app.index');
    }

	/**
	 *
	 * Store enterprise's data.
	 *
	 * @return Response
	 * 
	 */
    public function createEnterprise()
    {
    	return view('app.enterprise.create');
    }

    /**
	 *
	 * Store enterprise's data.
	 *
	 * @param EnterpriseRequest $request
	 *
	 * @return Response
	 * 
	 */
    public function storeEnterprise(EnterpriseRequest $request)
    {
    	$enterprise = new Enterprise();

    	$enterprise->name = $request->name;
    	$enterprise->cnpj = $request->cnpj;
    	$enterprise->address = $request->address;
    	$enterprise->telephone = $request->telephone;
    	$enterprise->site = $request->site;
    	$enterprise->email = $request->email;

    	$enterprise->save();

    	return view('app.index');
    }
}
