<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnterpriseThanksRequest;
use App\Mail\EnterpriseThanksMail;
use App\Models\Enterprise;
use App\Models\EnterpriseThanks;
use Auth;
use Illuminate\Http\Request;
use Mail;

class EnterpriseThanksAdminController extends Controller
{
    
    /**
     * Enterprises's list page
     *
     * @return Response
     */
    public function list()
    {
        return view('admin.enterprise-thanks.list');
    }

    /**
     * Index page
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $enterpriseThanks = EnterpriseThanks::with(['Enterprise', 'User'])->paginate(5);
        $enterprises = Enterprise::all();

        $response = [
            'pagination' => [
                'total' => $enterpriseThanks->total(),
                'per_page' => $enterpriseThanks->perPage(),
                'current_page' => $enterpriseThanks->currentPage(),
                'last_page' => $enterpriseThanks->lastPage(),
                'from' => $enterpriseThanks->firstItem(),
                'to' => $enterpriseThanks->lastItem()
            ],
            'data' => $enterpriseThanks,
            'enterprises' => $enterprises
        ];

        return response()->json($response);
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
        /**
         * 
         * @todo Create a test user for send enterprise thanks
         * 
         */
        $date = new \DateTime();        
        
        $enterpriseThanks = new EnterpriseThanks();

        $enterpriseThanks->user_id = Auth::guard('admins')->user()->id;
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

        $enterpriseThanks->save();

        $enterpriseThanks->hash = bcrypt($enterpriseThanks->id);
        $enterpriseThanks->save();

        /*$user = new UserAdminController();
        $enterprise = new EnterpriseAdminController();

        /Mail::to($enterprise->show($request->enterprise_id)->email)->send(new EnterpriseThanksMail($user->show(Auth::user()->id), $enterpriseThanks));*/
        
        return response()->json($enterpriseThanks);
    }

    /**
     *
     * Show enterprise-thanks data.
     * 
     * @param int $id
     *
     * @return EnterpriseThanks $enterpriseThanks
     * 
     */
    public function show($id)
    {
        $enterpriseThanks = EnterpriseThanks::findOrFail($id);
        return $enterpriseThanks;
    }

    /**
     * Update enterprise thank's data
     * 
     */
    public function update(EnterpriseThanksRequest $request, $id)
    {
        $enterpriseThanks = EnterpriseThanks::find($id);

        $enterpriseThanks->enterprise_id = $request->enterprise_id;
        $enterpriseThanks->content = $request->content;

        $enterpriseThanks->save();

        /*$enterprise = new EnterpriseAdminController();

        Mail::to($enterprise->show($request->enterprise_id)->email)->send(new EnterpriseThanksMail($user, $enterpriseThanks));*/
        
        return response()->json($enterpriseThanks);
    }

    /**
     *
     * Remove the enterprise thank.
     * 
     * @param int $id
     *
     * @return Response
     * 
     */
    public function destroy($id)
    {
        $delete = EnterpriseThanks::findOrFail($id)->delete();        
        return response()->json($delete);
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

    /**
     *
     * Approve enterprise's thanks.
     * 
     * @param int $id
     *
     */
    public static function approveEnterpriseThanks($enterpriseId)
    {
        $enterpriseThanks = EnterpriseThanks::where('enterprise_id', '=', $enterpriseId)->get();
        
        foreach ($enterpriseThanks as $enterpriseThank) {
            $enterpriseThank->status = 'Approved';
            
            if($enterpriseThank->save()) {
                $user = new UserAdminController();
                $enterprise = new EnterpriseAdminController();
                Mail::to($enterprise->show($enterpriseId)->email)->send(new EnterpriseThanksMail($user->show($enterpriseThank->user_id), $enterpriseThank));
            }    
        }
    }
}
