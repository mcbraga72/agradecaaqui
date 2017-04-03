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
use Image;

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
     * Categories's list page
     *
     * @return Response
     */
    public function list()
    {
        return view('enterprise.thanks.list');
    }

    /**
     * Index page
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $enterpriseThanks = EnterpriseThanks::where('enterprise_id', '=', Auth::guard('enterprises')->user()->id)->with(['Enterprise', 'User'])->latest()->paginate(5);
        //$enterpriseThanks = EnterpriseThanks::latest()->paginate(5);
        
        $response = [
            'pagination' => [
                'total' => $enterpriseThanks->total(),
                'per_page' => $enterpriseThanks->perPage(),
                'current_page' => $enterpriseThanks->currentPage(),
                'last_page' => $enterpriseThanks->lastPage(),
                'from' => $enterpriseThanks->firstItem(),
                'to' => $enterpriseThanks->lastItem()
            ],
            'data' => $enterpriseThanks
        ];

        return response()->json($response);
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
        $data = array(
            'numberOfIndividualUsersThanking' => EnterpriseThanks::where('enterprise_id', Auth::guard('enterprises')->user()->id)->distinct()->count('user_id'),
            'enterpriseThanksReceived' => EnterpriseThanks::where('enterprise_id', Auth::guard('enterprises')->user()->id)->count(),
            'rankingPosition' => DB::table('enterprise_thanks')->select(DB::raw('count(*) as enterpriseThanksCount, enterprise_id'))->groupBy('enterprise_id')->orderBy('enterpriseThanksCount', 'desc')->get()
        );

        /*$position = 1;

        foreach ($rankingPosition as $enterpriseRankingPosition) {
            if($enterpriseRankingPosition->enterprise_id == Auth::guard('enterprises')->user()->id) {
                return $position;
            }
            $position++;
        }*/
        
    	return view('enterprise.dashboard')->with('data', $data);
    }

    /**
	 *
	 * Shows edit profile's page
	 * 
	 * @return Response
	 * 
	 */
    public function editProfile($id)
    {
        $data = array(
            'enterprise' => Enterprise::findOrFail($id),
            'categories' => Category::all()
        );
    	
        return view('enterprise.profile')->with($data);
    }

    /**
	 * Update enterprise's data
	 * 
	 */
    public function updateProfile(EnterpriseRequest $request, $id)
    {
    	$enterprise = Enterprise::findOrFail($id);

    	$enterprise->category_id = $request->category_id;
    	$enterprise->name = $request->name;
    	$enterprise->contact = $request->contact;
    	$enterprise->email = $request->email;        
    	$enterprise->telephone = $request->telephone;
    	$enterprise->address = $request->address;        

    	$enterprise->save();

    	$enterpriseThanks = EnterpriseThanks::where('enterprise_id', Auth::guard('enterprises')->user()->id)->paginate(10);
    	return view('enterprise.thanks.list')->with('enterpriseThanks', $enterpriseThanks);
    }

    /**
     *
     * Change enterprise's password.
     *
     * @param Request $request
     * @param int $id
     *
     * @return Response
     * 
     */
    public function changePassword(Request $request, $id)
    {
        $enterprise = Enterprise::find($id);

        if (Hash::check($request->currentPassword, $enterprise->password)) {        
            $enterprise->password = bcrypt($request->password);
            $enterprise->save();
            return Redirect::back()->withSuccess(['msg', 'Senha alterada com sucesso!']);
        } else {
            return Redirect::back()->withErrors(['msg', 'Não foi possível alterar sua senha!']);            
        }
    }

    /**
     *
     * Update enterprise's logo.
     *
     * @param Request $request
     * @param int $id
     *
     * @return Response
     * 
     */
    public function updateLogo(Request $request, $id)
    {
        $enterprise = Enterprise::find($id);

        if(!is_null($request->logo)) {
            $logo = $request->file('logo');
            $filename = str_replace(' ', '', Auth::guard('enterprises')->user()->name) . '.' . $logo->getClientOriginalExtension();
            Image::make($logo)->resize(40, 40)->save(public_path() . '/images/enterprises/' . $filename);            
            $enterprise->logo = '/images/enterprises/' . $filename;
            $enterprise->save();            
            return response()->json($enterprise);
        } else {
            return Redirect::back()->withErrors(['msg', 'Não foi possível alterar o logo da empresa!']);
        }        
    }

    /**
	 *
	 * Shows all enterprise's thanks
     *
     * @return Response 
     * 
	 */
    public function thanks()
    {
    	$enterpriseThanks = EnterpriseThanks::where('enterprise_id', Auth::guard('enterprises')->user()->id)->paginate(10);
    	return view('enterprise.thanks.list')->with('enterpriseThanks', $enterpriseThanks);
    }

    /**
     *
     * Shows de enterprise thank
     *
     * @param int $id
     *
     * @return Response
     * 
     */
    public function replica($id)
    {
        $enterpriseThanks = EnterpriseThanks::findOrFail($id);
        return view('enterprise.thanks.replica')->with('enterpriseThanks', $enterpriseThanks);
    }

    /**
     *
     * Save replica in database
     *
     * @param int $id
     *
     * @return Response
     * 
     */
    public function storeReplica(Request $request, $id)
    {
        $enterpriseThank = EnterpriseThanks::findOrFail($id);
        //dd($enterpriseThank);
        $enterpriseThank->replica = $request->replica;

        $enterpriseThank->save();

        $enterpriseThanks = EnterpriseThanks::where('enterprise_id', Auth::guard('enterprises')->user()->id)->paginate(10);
        return view('enterprise.thanks.list')->with('enterpriseThanks', $enterpriseThanks);
    }
    
}
