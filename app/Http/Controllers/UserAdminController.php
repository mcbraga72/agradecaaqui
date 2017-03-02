<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;

class UserAdminController extends Controller
{
    /**
	 *
	 * Show user's list.
	 *
	 * @return Response
	 * 
	 */
    public function index()
    {
    	$users = User::all();
    	return view('admin.user.list')->with('users', $users);    	
    }

    /**
	 *
	 * Show the form to create a new user
	 *
	 * @return Response
	 * 
	 */
    public function create()
    {    	
    	return view('admin.user.create');
    }

    /**
	 *
	 * Store a new user.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 * 
	 */
    public function store(UserRequest $request)
    {
    	$user = new User();

    	$user->name = $request->name;
    	$user->surName = $request->surName;
        $user->gender = $request->gender;
        $user->dateOfBirth = $request->dateOfBirth;
        $user->telephone = $request->telephone;
        $user->city = $request->city;
        $user->state = $request->state;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);

    	$user->save();

    	$users = User::all();
    	return view('admin.user.list')->with('users', $users);
    }

    /**
	 *
	 * Show user data.
	 * 
	 * @param int $id
	 *
	 * @return User $user
	 * 
	 */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return $user;
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
    public function edit($id)
    {
    	return view('admin.user.profile', ['user' => User::findOrFail($id)]);
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
        $user->city = $request->city;
        $user->state = $request->state;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);

    	$user->save();

    	$users = User::all();
    	return view('admin.user.list')->with('users', $users);
    }

    /**
	 *
	 * Delete the user.
	 *
	 * @param int $id
	 *
	 * @return Response
	 * 
	 */
    public function destroy($id)
    {
    	$user = User::findOrFail($id);
    	$user->delete();

    	$users = User::all();
    	return view('admin.user.list')->with('users', $users);
    }
}
