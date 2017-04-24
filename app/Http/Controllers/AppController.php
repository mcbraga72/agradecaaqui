<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnterpriseRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CompleteUserRegisterRequest;
use App\Models\Category;
use App\Models\Enterprise;
use App\Models\EnterpriseThanks;
use App\Models\User;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Image;
use Redirect;

class AppController extends Controller
{	
	/**
	 * Dashboard page
	 *
	 * @return Response
	 */
	public function dashboard()
	{
        $usersThanks = DB::table('user_thanks')->join('users', 'users.id', '=', 'user_thanks.user_id')->select('receiptName', 'content', DB::raw("'people'"), 'hash');
        $allThanks = DB::table('enterprise_thanks')->join('enterprises', 'enterprises.id', '=', 'enterprise_thanks.enterprise_id')->select('name', 'content', 'logo', 'hash')->union($usersThanks)->get();

		$data = array(
			'enterprises' => Enterprise::all(),
            'allThanks' => $allThanks,
			'user' => User::select('registerType')->where('id', '=', Auth::user()->id)->get()
		);
        return view('app.index')->with('data', $data);    	
	}

	/**
     *
     * Change user's password.
     *
     * @param Request $request
     * @param int $id
     *
     * @return Response
     * 
     */
    public function changePassword(Request $request)
    {
        if (Hash::check($request->currentPassword, Auth::user()->password)) {
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->password);
            $user->save();
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    /**
     *
     * Update user's avatar.
     *
     * @param Request $request
     * @param int $id
     *
     * @return Response
     * 
     */
    public function updateAvatar(Request $request, $id)
    {
        $user = User::find($id);

        if(!is_null($request->photo)) {
            $photo = $request->file('photo');
            $filename = Auth::user()->email . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(40, 40)->save(public_path() . '/images/photos/' . $filename);            
            $user->photo = '/images/photos/' . $filename;
            $user->save();            
            return response()->json($user);
        } else {
            return Redirect::back()->withErrors(['msg', 'Não foi possível alterar a foto do perfil!']);
        }        
    }

    /**
	 *
	 * Shows enterprise and user thanks.
	 *
	 * @return Response
	 * 
	 */
	public function thanks()
    {
    	$usersThanks = DB::table('user_thanks')->select('receiptName', 'content', DB::raw("'people'"), 'hash');
		$allThanks = DB::table('enterprise_thanks')->join('enterprises', 'enterprises.id', '=', 'enterprise_thanks.enterprise_id')->select('name', 'content', 'logo', 'hash')->union($usersThanks)->get();
		
		return view('app.thanks')->with('allThanks', $allThanks);
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

        $enterprise->category_id = $request->category_id;
    	$enterprise->name = $request->name;
    	$enterprise->contact = $request->contact;
        $enterprise->email = $request->email;
        $enterprise->telephone = $request->telephone;
        $enterprise->address = $request->address;    	
    	$enterprise->status = 'Pending';

    	$enterprise->save();

    	return response()->json($enterprise);
    }

    /**
     *
     * Autocomplete field - Enterprise names
     *
     * @param string $name
     *
     * @return Response
     * 
     */
    public function findEnterprise(Request $request)
    {
        $results = array();
    	$enterprises = Enterprise::where('name', 'LIKE', '%' . $request->input('query') . '%')->orderBy('name', 'asc')->get();

    	foreach ($enterprises as $enterprise) {
	    	$results[] = ['id' => $enterprise->id, 'name' => $enterprise->name];
		}
		
		return response()->json($results);
    }

    /**
     *
     * Find enterprise and user thanks based in keywords given by the user.
     *
     * @param Request $request
     *
     * @return Response
     * 
     */
    public function findThanks(Request $request)
    {
        $usersThanks = DB::table('user_thanks')->select('receiptName', 'content', DB::raw("'people'"), 'hash')->where('content', 'LIKE', "%{$request->search}%");
		$allThanks = DB::table('enterprise_thanks')->join('enterprises', 'enterprises.id', '=', 'enterprise_thanks.enterprise_id')->select('name', 'content', 'logo', 'hash')->where('content', 'LIKE', "%{$request->search}%")->union($usersThanks)->get();
		
		return view('app.thanks')->with('allThanks', $allThanks);
    }

    /**
     *
     * Get all categories.
     *
     * @return Response
     * 
     */
    public function getCategories()
    {
        $categories = Category::all();

        $response = [        
            'data' => $categories
        ];
        
        return response()->json($response);        
    }

    /**
     *
     * Get all enterprises.
     *
     * @return Response
     * 
     */
    public function getEnterprises()
    {
        $enterprises = Enterprise::all();

        $response = [        
            'data' => $enterprises
        ];
        
        return response()->json($response);        
    }
}
