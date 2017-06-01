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
    	
        $enterprise = new EnterpriseAdminController();
        $status = $enterprise->verifyStatus($request->enterprise_id);

        if($status == 'Pending') {
            $enterpriseThanks->status = 'Pending';
        } else {
            $enterpriseThanks->status = 'Approved';
        }

    	if($enterpriseThanks->save()) {

            $enterpriseThanks->hash = preg_replace('/[^A-Za-z0-9\-]/', '', bcrypt($enterpriseThanks->id));
            $enterpriseThanks->save();

            $user = new UserAdminController();            

            Mail::to($enterprise->show($request->enterprise_id)->email)->send(new EnterpriseThanksMail($user->show(Auth::user()->id), $enterpriseThanks));

            $usersThanks = DB::table('user_thanks')->join('users', 'users.id', '=', 'user_thanks.user_id')->select('receiptName AS name', 'content', DB::raw("'people' AS logo"), 'hash', DB::raw('DATE_FORMAT(thanksDateTime, "%d/%m/%Y") as date'))->where('user_id', '=', Auth::user()->id)->orderBy('thanksDateTime', 'desc')->get();
            $enterprisesThanks = DB::table('enterprise_thanks')->join('enterprises', 'enterprises.id', '=', 'enterprise_thanks.enterprise_id')->select('name', 'content', 'logo', 'hash', DB::raw('DATE_FORMAT(thanksDateTime, "%d/%m/%Y") as date'))->where('user_id', '=', Auth::user()->id)->orderBy('thanksDateTime', 'desc')->get();

            $allThanks = $usersThanks->merge($enterprisesThanks);

            $data = array(
                'enterprises' => Enterprise::all(),
                'allThanks' => $allThanks,
                'user' => User::select('registerType')->where('id', '=', Auth::user()->id)->get()
            );
            return view('app.index')->with('data', $data)->withSuccess('Agradecimento enviado com sucesso!');

        }    
    }

    /**
	 *
	 * Show enterprise thanks data.
	 * 
	 * @param String $hash
	 *
	 * @return Response
	 * 
	 */
    public function show($hash)
    {
        $enterpriseThanks = EnterpriseThanks::where('hash', '=', $hash)->with('enterprise')->get();
        return view('app.enterprise-thanks.show')->with('enterpriseThanks', $enterpriseThanks);
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
    	return view('app.enterprise-thanks.show', ['user' => EnterpriseThanks::findOrFail($id)]);
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

        $usersThanks = DB::table('user_thanks')->join('users', 'users.id', '=', 'user_thanks.user_id')->select('receiptName AS name', 'content', DB::raw("'people' AS logo"), 'hash', DB::raw('DATE_FORMAT(thanksDateTime, "%d/%m/%Y") as date'))->where('user_id', '=', Auth::user()->id)->orderBy('thanksDateTime', 'desc')->get();
        $enterprisesThanks = DB::table('enterprise_thanks')->join('enterprises', 'enterprises.id', '=', 'enterprise_thanks.enterprise_id')->select('name', 'content', 'logo', 'hash', DB::raw('DATE_FORMAT(thanksDateTime, "%d/%m/%Y") as date'))->where('user_id', '=', Auth::user()->id)->orderBy('thanksDateTime', 'desc')->get();

        $allThanks = $usersThanks->merge($enterprisesThanks);

        $data = array(
            'enterprises' => Enterprise::all(),
            'allThanks' => $allThanks,
            'user' => User::select('registerType')->where('id', '=', Auth::user()->id)->get()
        );
        return view('app.index')->with('data', $data)->withSuccess('Agradecimento atualizado com sucesso!');
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
    	return view('app.index')->with('enterprisesThanks', $enterprisesThanks);
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
        return view('app.index')->with('enterprisesThanks', $enterprisesThanks);
    }
}
