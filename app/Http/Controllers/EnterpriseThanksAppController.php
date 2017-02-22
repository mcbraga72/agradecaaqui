<?php

namespace App\Http\Controllers;

use App\Mail\EnterpriseThanksMail;
use App\Models\Enterprise;
use App\Models\EnterpriseThanks;
use App\Http\Requests\EnterpriseThanksRequest;
use Auth;

class EnterpriseThanksAppController extends Controller
{
    /**
	 *
	 * Show enterprise thank's list.
	 *
	 * @return Response
	 * 
	 */
    public function index()
    {
    	$enterprisesThanks = EnterpriseThanks::all();
    	return view('app.enterprise-thanks.list')->with('enterprisesThanks', $enterprisesThanks);
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
    	$enterprises = Enterprise::all();
    	return view('app.enterprise-thanks.create')->with('enterprises', $enterprises);
    }

    /**
	 *
	 * Add new enterprise to the database.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 * 
	 */
    public function store(EnterpriseThanksRequest $request)
    {
        $date = new \DateTime();        
        
        $enterpriseThanks = new EnterpriseThanks();

        $enterpriseThanks->user_id = Auth::user()->id;
    	$enterpriseThanks->enterprise_id = $request->enterprise_id;
        $enterpriseThanks->thanksDateTime = $date->format('Y-m-d H:i:s');
        $enterpriseThanks->content = $request->content;
    	$enterpriseThanks->status = 'Pending';

    	$enterpriseThanks->save();

        $enterprise = new Enterprise();

        Mail::to($enterprise->show()->email)->send(new EnterpriseThanksMail($user, $enterpriseThanks));

    	$enterprisesThanks = EnterpriseThanks::all();
    	return view('app.enterprise-thanks.list')->with('enterprisesThanks', $enterprisesThanks);
    }

    /**
	 *
	 * Show enterprise data.
	 * 
	 * @param int $id
	 *
	 * @return Response
	 * 
	 */
    public function show($id)
    {
    	return view('app.enterprise-thanks.profile', ['user' => EnterpriseThanks::findOrFail($id)]);
    }

    /**
	 *
	 * Edit enterprise data.
	 *
	 * @param int $id
	 *
	 * @return Response
	 * 
	 */
    public function edit($id)
    {
    	return view('app.enterprise-thanks.profile', ['user' => EnterpriseThanks::findOrFail($id)]);
    }

    /**
	 *
	 * Update enterprise thank's data.
	 *
	 * @param int $id
	 *
	 * @return Response
	 * 
	 */
    public function update(EnterpriseThanksRequest $request, $id)
    {
    	$enterpriseThanks = EnterpriseThanks::find($id);

    	$enterpriseThanks->enterprise_id = $request->enterprise_id;
    	$enterpriseThanks->content = $request->content;

    	$enterpriseThanks->save();

        $enterprise = new Enterprise();

        Mail::to($enterprise->show()->email)->send(new EnterpriseThanksMail($user, $enterpriseThanks));

    	$enterprisesThanks = EnterpriseThanks::all();        
    	return view('app.enterprise-thanks.list')->with('enterprisesThanks', $enterprisesThanks);   	
    }

    /**
	 *
	 * Delete the enterprise.
	 *
	 * @param int $id
	 *
	 * @return Response
	 * 
	 */
    public function destroy()
    {
    	$enterpriseThanks = EnterpriseThanks::findOrFail($id);
    	$enterpriseThanks->delete();

    	$enterprisesThanks = EnterpriseThanks::all();
    	return view('app.enterprise-thanks.list')->with('enterprisesThanks', $enterprisesThanks);
    }
}
