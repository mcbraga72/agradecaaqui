<?php

namespace App\Http\Controllers;

use App\Mail\UserThanksMail;
use App\Models\User;
use App\Models\UserThanks;
use App\Http\Requests\UserThanksRequest;
use Auth;
use Illuminate\Http\Request;
use Mail;

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
        
        $userThanks = new UserThanks();

        $userThanks->user_id = Auth::user()->id;
    	$userThanks->receiptName = $request->receiptName;
    	$userThanks->receiptEmail = $request->receiptEmail;
        $userThanks->thanksDateTime = $date->format('Y-m-d H:i:s');
        $userThanks->content = $request->content;
    	
    	if($userThanks->save()) {

            $userThanks->hash = bcrypt($userThanks->id);
            $userThanks->save();
            
            $user = new UserAdminController();

            Mail::to($request->receiptEmail)->send(new UserThanksMail($user->show(Auth::user()->id), $userThanks));

        	$usersThanks = UserThanks::all();
        	return view('app.user-thanks.list')->with('usersThanks', $usersThanks)->withSuccess('Agradecimento cadastrado com sucesso!');
        }    
    }

    /**
     *
     * Show user thanks data.
     * 
     * @param String $hash
     *
     * @return Response
     * 
     */
    public function show($hash)
    {
        $userThanks = UserThanks::where('hash', '=', $hash)->with('user')->get();
        return view('app.user-thanks.show')->with('userThanks', $userThanks);
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

    /**
     *
     * Find user thanks based in keywords given by the user.
     *
     * @param Request $request
     *
     * @return Response
     * 
     */
    public function find(Request $request)
    {
        $usersThanks = UserThanks::where('content', 'LIKE', "%{$request->search}%")->get();
        return view('app.user-thanks.list')->with('usersThanks', $usersThanks);
    }
}
