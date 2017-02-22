<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserThanks;
use App\Http\Requests\UserThanksRequest;

class UserThanksAppController extends Controller
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
    	return view('app.user-thanks.list')->with('usersThanks', $usersThanks);
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
    	return view('app.user-thanks.create');
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
    	$date = new \DateTime();        
        
        $userThanks = new EnterpriseThanks();

        $userThanks->user_id = Auth::user()->id;
    	$userThanks->receiptName = $request->receiptName;
    	$userThanks->receiptEmail = $request->receiptEmail;
        $userThanks->thanksDateTime = $date->format('Y-m-d H:i:s');
        $userThanks->content = $request->content;
    	
    	$userThanks->save();

        Mail::to($request->receiptEmail)->send(new UserThanksMail($user, $userThanks));

    	$usersThanks = UserThanks::all();
    	return view('app.user-thanks.list')->with('usersThanks', $usersThanks);
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
    	return view('app.user-thanks.profile', ['user' => UserThanks::findOrFail($id)]);
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
    	return view('app.user-thanks.profile', ['user' => UserThanks::findOrFail($id)]);
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
    	return view('app.user-thanks.list')->with('usersThanks', $usersThanks);

    	Mail::to($request->user())->send(new UserThanksMail($user, $userThanks));
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
    	return view('app.user-thanks.list')->with('usersThanks', $usersThanks);
    }
}
