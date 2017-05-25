<?php

namespace App\Http\Controllers;

use App\Mail\UserThanksMail;
use App\Models\Enterprise;
use App\Models\User;
use App\Models\UserThanks;
use App\Http\Requests\UserThanksRequest;
use Auth;
use DB;
use Illuminate\Http\Request;
use Mail;

class UserThanksAppController extends Controller
{
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

        	$usersThanks = DB::table('user_thanks')->join('users', 'users.id', '=', 'user_thanks.user_id')->select('receiptName', 'content', DB::raw("'people'"), 'hash')->where('user_id', '=', Auth::user()->id)->get();
            $enterprisesThanks = DB::table('enterprise_thanks')->join('enterprises', 'enterprises.id', '=', 'enterprise_thanks.enterprise_id')->select('name', 'content', 'logo', 'hash')->where('user_id', '=', Auth::user()->id)->get();

            $data = array(
                'enterprises' => Enterprise::all(),
                'enterprisesThanks' => $enterprisesThanks,
                'usersThanks' => $usersThanks,
                'user' => User::select('registerType')->where('id', '=', Auth::user()->id)->get()
            );
            return view('app.index')->with('data', $data)->withSuccess('Agradecimento cadastrado com sucesso!');
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
