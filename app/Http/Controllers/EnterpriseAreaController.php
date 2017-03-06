<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnterpriseRequest;
use App\Models\Category;
use App\Models\Enterprise;
use App\Models\EnterpriseThanks;
use Auth;
use DB;
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
