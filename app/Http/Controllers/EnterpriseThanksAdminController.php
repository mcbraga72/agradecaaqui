<?php

namespace App\Http\Controllers;

use App\Models\Enterprise;
use App\Models\EnterpriseThanks;
use App\Http\Requests\EnterpriseThanksRequest;
use Auth;

class EnterpriseThanksAdminController extends Controller
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
    	$enterprisesThanks = EnterpriseThanks::with('Enterprise')->get();
    	return view('admin.enterprise-thanks.list')->with('enterprisesThanks', $enterprisesThanks);
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
    	return view('admin.enterprise-thanks.create')->with('enterprises', $enterprises);
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
        $enterpriseThanks->status = 'Approved';

        $enterpriseThanks->save();

        $user = new UserAdminController();
        $enterprise = new EnterpriseAdminController();

        //Mail::to($enterprise->show($request->enterprise_id)->email)->send(new EnterpriseThanksMail($user->show(Auth::user()->id), $enterpriseThanks));

        $enterprisesThanks = EnterpriseThanks::with(['User', 'Enterprise'])->get();
        return view('admin.enterprise-thanks.list')->with('enterprisesThanks', $enterprisesThanks);    	
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
    	return view('admin.enterprise-thanks.profile', ['user' => EnterpriseThanks::findOrFail($id)]);
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
    	return view('admin.enterprise-thanks.profile', ['user' => EnterpriseThanks::findOrFail($id)]);
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

        $enterprise = new EnterpriseAdminController();

        //Mail::to($enterprise->show($request->enterprise_id)->email)->send(new EnterpriseThanksMail($user, $enterpriseThanks));

        $enterprisesThanks = EnterpriseThanks::with('enterprise')->get();
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
    public function destroy($id)
    {
    	$enterpriseThanks = EnterpriseThanks::findOrFail($id);
    	$enterpriseThanks->delete();

    	$enterprisesThanks = EnterpriseThanks::with('Enterprise')->get();
    	return view('admin.enterprise-thanks.list')->with('enterprisesThanks', $enterprisesThanks);
    }

    /**
     *
     * Select enterprise names to fill autocomplete field
     * 
     * @param Request
     *
     * @return Response
     * 
     */
    public function autocomplete(Request $request)
    {
        $data = Enterprise::select('name')->where('name',"LIKE","%{$request->input('query')}%")->get();
        return response()->json($data);
     
    }    
}
