<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserThanks;
use App\Http\Requests\UserThanksRequest;
use Illuminate\Http\Request;

class UserThanksAdminController extends Controller
{
    
    /**
     * Users's list page
     *
     * @return Response
     */
    public function list()
    {
        /*$userThanks = UserThanks::with('user')->paginate(5);
        dd($userThanks);*/
        return view('admin.user-thanks.list');
    }

    /**
     * Index page
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $userThanks = UserThanks::with('user')->paginate(5);

        $response = [
            'pagination' => [
                'total' => $userThanks->total(),
                'per_page' => $userThanks->perPage(),
                'current_page' => $userThanks->currentPage(),
                'last_page' => $userThanks->lastPage(),
                'from' => $userThanks->firstItem(),
                'to' => $userThanks->lastItem()
            ],
            'data' => $userThanks   
        ];

        return response()->json($response);
    }
    
    /**
     *
     * Add new user-thanks to the database.
     *
     * @param Request $request
     *
     * @return Response
     * 
     */
    public function store(UserThanksRequest $request)
    {
        /**
         * 
         * @todo Create a test user for send user thanks
         * 
         */
        
        $date = new \DateTime();        
        
        $userThanks = new UserThanks();

        $userThanks->user_id = Auth::user()->id;
        $userThanks->receiptName = $request->receiptName;
        $userThanks->receiptEmail = $request->receiptEmail;
        $userThanks->thanksDateTime = $date->format('Y-m-d H:i:s');
        $userThanks->content = $request->content;
        
        $userThanks->save();

        /*$user = new UserAdminController();

        Mail::to($request->receiptEmail)->send(new UserThanksMail($user->show(Auth::user()->id), $userThanks));*/

        return response()->json($userThanks);
    }

    /**
     *
     * Show user-thanks data.
     * 
     * @param int $id
     *
     * @return UserThanks $userThanks
     * 
     */
    public function show($id)
    {
        $userThanks = UserThanks::findOrFail($id);
        return $userThanks;
    }

    /**
     * Update user thank's data
     * 
     */
    public function update(UserThanksRequest $request, $id)
    {
        $userThanks = UserThanks::find($id);

        $userThanks->receiptName = $request->receiptName;
        $userThanks->receiptEmail = $request->receiptEmail;
        $userThanks->content = $request->content;

        $userThanks->save();

        /*$user = new UserAdminController();

        Mail::to($user->show($request->user_id)->email)->send(new UserThanksMail($user, $userThanks));*/
        
        return response()->json($userThanks);
    }

    /**
     *
     * Remove the user thank.
     * 
     * @param int $id
     *
     * @return Response
     * 
     */
    public function destroy($id)
    {
        $delete = UserThanks::findOrFail($id)->delete();        
        return response()->json($delete);
    }
    
}
