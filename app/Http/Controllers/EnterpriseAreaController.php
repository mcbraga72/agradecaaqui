<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnterpriseRequest;
use App\Models\Category;
use App\Models\Enterprise;
use App\Models\EnterpriseThanks;
use App\Models\User;
use Auth;
use DateTime;
use DB;
use Hash;
use Illuminate\Http\Request;
use Image;
use Redirect;
use Response;

class EnterpriseAreaController extends Controller
{
	/**
	 * 
	 * Constructor for EnterpriseAreaController class
	 * 
	 */
	public function __construct()
	{
		
	}

    /**
     * Thnak's list page
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
            'numberOfIndividualUsersThanking' => EnterpriseThanks::where('enterprise_id', '=', Auth::guard('enterprises')->user()->id)->distinct()->count('user_id'),
            'enterpriseThanksReceived' => EnterpriseThanks::where('enterprise_id', '=', Auth::guard('enterprises')->user()->id)->count(),
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
    public function editProfile()
    {
        $data = array(
            'enterprise' => Enterprise::findOrFail(Auth::guard('enterprises')->user()->id),
            'categories' => Category::all()
        );
    	
        return view('enterprise.profile')->with($data);
    }

    /**
	 * Update enterprise's data
	 * 
	 */
    public function updateProfile(EnterpriseRequest $request)
    {
    	$enterprise = Enterprise::findOrFail(Auth::guard('enterprises')->user()->id);

    	$enterprise->category_id = $request->category_id;
    	$enterprise->name = $request->name;
    	$enterprise->contact = $request->contact;
    	$enterprise->email = $request->email;
        $enterprise->site = $request->site;
    	$enterprise->telephone = $request->telephone;
    	$enterprise->address = $request->address;
        $enterprise->neighborhood = $request->neighborhood;
        $enterprise->city = $request->city;
        $enterprise->state = $request->state;
        $enterprise->cpf = $request->cpf;
        $enterprise->cnpj = $request->cnpj;

    	$enterprise->save();

    	$enterpriseThanks = EnterpriseThanks::where('enterprise_id', '=', Auth::guard('enterprises')->user()->id)->paginate(10);
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
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
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
    public function updateLogo(Request $request)
    {
        if(!is_null($request->logo)) {
            $enterprise = Enterprise::find(Auth::guard('enterprises')->user()->id);
            if ($enterprise->logo != '/images/enterprises/enterprise.png') {
                unlink(public_path() . $enterprise->logo);
            }
            $timestamp = new DateTime();
            $logo = $request->file('logo');
            $filename = str_replace(' ', '', Auth::guard('enterprises')->user()->name) . '-' . $timestamp->getTimestamp() . '.' . $logo->getClientOriginalExtension();
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
    	$enterpriseThanks = EnterpriseThanks::where('enterprise_id', '=', Auth::guard('enterprises')->user()->id)->paginate(10);
    	return view('enterprise.thanks.list')->with('enterpriseThanks', $enterpriseThanks);
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
    public function storeReplica(Request $request)
    {
        $enterpriseThank = EnterpriseThanks::whereHash($request->hash)->firstOrFail();
        $enterpriseThank->replica = $request->replica;
        $enterpriseThank->save();

        $enterpriseThanks = EnterpriseThanks::where('enterprise_id', '=', Auth::guard('enterprises')->user()->id)->paginate(10);
        return view('enterprise.thanks.list')->with('enterpriseThanks', $enterpriseThanks);
    }

    /**
     * Premium Access Page
     *
     * @return Response
     */
    public function premium()
    {
        return view('enterprise.premium');
    }

    /**
     * Set enterprise's password for the first access
     *
     * @return Response
     */
    public function showConfirmationPage()
    {
        return view('enterprise.confirm-register');
    }

    /**
     * Set enterprise's password for the first access
     *
     * @return Response
     */
    public function setPassword(Request $request, $confirmationCode)
    {
        $enterprise = Enterprise::where('confirmation_code', '=', $confirmationCode)->firstOrFail();
        $enterprise->password = bcrypt($request->password);
        $enterprise->confirmation_code = '';
        $enterprise->confirmed = 0;
        $enterprise->save();

        return redirect('/empresa/entrar');
    }

    /**
     *
     * Export enterprise thanks register to a CSV file.
     * 
     * @return Response
     * 
     */
    public function exportEnterpriseThanksRegister()
    {
        $enterpriseThanks = EnterpriseThanks::where('enterprise_id', '=', Auth::guard('enterprises')->user()->id)->with(['Enterprise', 'User'])->orderBy('thanksDateTime', 'desc')->get();
        $filename = 'agradecimentos-empresa.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Cliente', 'Data/Hora', 'Agradecimento', 'Réplica', 'Tréplica'));

        foreach($enterpriseThanks as $enterpriseThank) {
            $thanksDateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $enterpriseThank['thanksDateTime']);
            fputcsv($handle, array($enterpriseThank['user']['name'], $thanksDateTime->format('d/m/Y H:i'), $enterpriseThank['content'], $enterpriseThank['replica'], $enterpriseThank['rejoinder']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'agradecimentos-empresa.csv', $headers);
    }
}
