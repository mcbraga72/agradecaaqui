<?php

namespace App\Http\Controllers;

use App\Http\Controllers\EnterpriseAdminController;
use App\Http\Requests\EnterpriseThanksRequest;
use App\Mail\EnterpriseThanksMail;
use App\Models\Enterprise;
use App\Models\EnterpriseThanks;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Mail;

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
    	$enterprisesThanks = EnterpriseThanks::with('enterprise')->get();
    	return view('app.enterprise-thanks.list')->with('enterprisesThanks', $enterprisesThanks);
    }

    /**
	 *
	 * Show the creation form
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
	 * Add new enterprise thanks to the database.
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

    	if($enterpriseThanks->save()) {

            $user = new UserAdminController();
            $enterprise = new EnterpriseAdminController();

            Mail::to($enterprise->show($request->enterprise_id)->email)->send(new EnterpriseThanksMail($user->show(Auth::user()->id), $enterpriseThanks));

            $enterprisesThanks = EnterpriseThanks::with('Enterprise')->orderBy('thanksDateTime', 'desc')->get();
            return view('app.enterprise-thanks.list')->with('enterprisesThanks', $enterprisesThanks)->withSuccess('Agradecimento cadastrado com sucesso!');
        }    
    }

    /**
	 *
	 * Show enterprise thanks data.
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
	 * Edit enterprise thanks data.
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

        $enterprise = new EnterpriseAdminController();

        Mail::to($enterprise->show($request->enterprise_id)->email)->send(new EnterpriseThanksMail($user, $enterpriseThanks));

    	$enterprisesThanks = EnterpriseThanks::with('enterprise')->get();
    	return view('app.enterprise-thanks.list')->with('enterprisesThanks', $enterprisesThanks);   	
    }

    /**
	 *
	 * Delete the enterprise thanks.
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

    	$enterprisesThanks = EnterpriseThanks::with('enterprise')->get();
    	return view('app.enterprise-thanks.list')->with('enterprisesThanks', $enterprisesThanks);
    }

    /**
     *
     * Find enterprise thanks based in keywords given by the user.
     *
     * @param Request $request
     *
     * @return Response
     * 
     */
    public function find(Request $request)
    {
        $enterprisesThanks = EnterpriseThanks::where('content', 'LIKE', "%{$request->search}%")->get();
        return view('app.enterprise-thanks.list')->with('enterprisesThanks', $enterprisesThanks);
    }
}
