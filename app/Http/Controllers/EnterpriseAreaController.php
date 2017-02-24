<?php

namespace App\Http\Controllers;

use App\Models\Enterprise;
use App\Models\EnterpriseThanks;
use Illuminate\Http\Request;

class EnterpriseAreaController extends Controller
{
	/**
	 * 
	 * Constructor for EnterpriseAreaController class
	 * 
	 */
	public function __construct()
	{
		$this->middleware('enterprise.area');
	}

	/**
	 *
	 * Shows dashboard
	 * 
	 * @return Response
	 * 
	 */
    public function dashboard()
    {
    	return view('enterprise.dashboard');
    }

    /**
	 *
	 * Shows edit profile's page
	 * 
	 * @return Response
	 * 
	 */
    public function editProfile()
    {
    	return view('enterprise.profile', ['user' => Enterprise::findOrFail($id)]);
    }

    /**
	 * Update enterprise's data
	 * 
	 */
    public function updateProfile(EnterpriseRequest $request)
    {
    	$enterprise = new Enterprise();

    	$enterprise->category_id = $request->category_id;
    	$enterprise->name = $request->name;
    	$enterprise->contact = $request->contact;
    	$enterprise->email = $request->email;        
    	$enterprise->telephone = $request->telephone;
    	$enterprise->address = $request->address;
        $enterprise->status = 'Approved';

    	$enterprise->save();

    	$enterprisesThanks = EnterpriseThanks::where('enterprise_id', $id)->paginate(10);
    	return view('enterprise.dashboard')->with('enterprises', $enterprises);
    }

    /**
	 *
	 * 
	 */
    public function thanks()
    {
    	$enterpriseThanks = EnterpriseThanks::where('enterprise_id', $id)->paginate(10);
    	return view('enterprise.thanks.list')->with('enterpriseThanks', $enterpriseThanks);
    }
}
