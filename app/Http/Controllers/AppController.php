<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnterpriseRequest;
use App\Models\Category;
use App\Models\Enterprise;
use App\Models\EnterpriseThanks;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
		$data = array(
			'enterprises' => Enterprise::all(),
			'enterpriseThanks' => EnterpriseThanks::where('user_id', Auth::user()->id)->orderBy('thanksDateTime', 'desc')->take(9)->get()
		);
    	return view('app.index')->with('data', $data);    	
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
        $user->city = $request->city;
        $user->state = $request->state;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);

    	$user->save();
    	
    	return view('app.index');
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
    	$usersThanks = DB::table('user_thanks')->select('receiptName', 'content', DB::raw("'people'"));
		$enterprisesThanks = DB::table('enterprise_thanks')->join('enterprises', 'enterprises.id', '=', 'enterprise_thanks.enterprise_id')->select('name', 'content', 'logo')->union($usersThanks)->get();
		
		return view('app.thanks')->with('enterprisesThanks', $enterprisesThanks);
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
    	$categories = Category::all();
    	return view('app.enterprise.create')->with('categories', $categories);
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
    	$enterprise->status = 'Pending';

    	$enterprise->save();

    	return view('app.index');
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
    	$usersThanks = DB::table('user_thanks')->select('receiptName', 'content', DB::raw("'people'"));
		$enterprisesThanks = DB::table('enterprise_thanks')->join('enterprises', 'enterprises.id', '=', 'enterprise_thanks.enterprise_id')->select('name', 'content', 'logo')->union($usersThanks)->get();
		
		return view('app.thanks')->with('enterprisesThanks', $enterprisesThanks);
		
        //$enterprisesThanks = EnterpriseThanks::where('content', 'LIKE', "%{$request->search}%")->get();        
    }
}
