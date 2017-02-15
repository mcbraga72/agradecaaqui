<?php

namespace App\Http\Controllers;

use App\Models\UserThanks;
use App\Http\Requests\UserThanksRequest;

class UserThanksAdminController extends Controller
{
    /**
	 *
	 * Show user's thanks list.
	 *
	 * @return Response
	 * 
	 */
    public function index()
    {
    	$usersThanks = UserThanks::all();
    	return view('admin.user-thanks.list')->with('usersThanks', $usersThanks);
    }

    /**
	 *
	 * Show de creation form
	 *
	 * @return Response
	 * 
	 */
    public function create()
    {    	
    	return view('admin.user-thanks.create');
    }

    /**
	 *
	 * Add new user thanks to the database.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 * 
	 */
    public function store(UserThanksRequest $request)
    {
    	$userThanks = new UserThanks();

    	$userThanks->receipt = $request->receipt;
    	$userThanks->content = $request->content;

    	$userThanks->save();

    	$usersThanks = UserThanks::all();
    	return view('admin.user-thanks.list')->with('usersThanks', $usersThanks);
    }

    /**
	 *
	 * Show user thanks data.
	 * 
	 * @param int $id
	 *
	 * @return Response
	 * 
	 */
    public function show($id)
    {
    	return view('admin.user-thanks.profile', ['user' => UserThanks::findOrFail($id)]);
    }

    /**
	 *
	 * Edit user thanks data.
	 *
	 * @param int $id
	 *
	 * @return Response
	 * 
	 */
    public function edit($id)
    {
    	return view('admin.user-thanks.profile', ['user' => UserThanks::findOrFail($id)]);
    }

    /**
	 *
	 * Update user's thanks data.
	 *
	 * @param int $id
	 *
	 * @return Response
	 * 
	 */
    public function update(UserThanksRequest $request, $id)
    {
    	$userThanks = UserThanks::find($id);

    	$userThanks->receipt = $request->receipt;
    	$userThanks->content = $request->content;

    	$userThanks->save();

    	$usersThanks = UserThanks::all();
    	return view('admin.user-thanks.list')->with('usersThanks', $usersThanks);
    }

    /**
	 *
	 * Delete the user thanks.
	 *
	 * @param int $id
	 *
	 * @return Response
	 * 
	 */
    public function destroy()
    {
    	$userThanks = UserThanks::findOrFail($id);
    	$userThanks->delete();

    	$usersThanks = UserThanks::all();
    	return view('admin.user-thanks.list')->with('usersThanks', $usersThanks);
    }
}
