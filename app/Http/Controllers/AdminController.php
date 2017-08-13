<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Enterprise;
use App\Models\EnterpriseThanks;
use App\Models\User;
use App\Models\UserThanks;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	/**
	 * 
	 * Constructor for EnterpriseAreaController class
	 * 
	 */
	public function __construct()
	{
		$this->middleware('admin.area');
	}

	/**
	 * Dashboard page
	 *
	 * @return Response
	 */
	public function dashboard()
	{
		$data = array(
			'users' => User::count(),
			'enterprises' => Enterprise::count(),
			'categories' => Category::count(),
			'thanks' => UserThanks::count() + EnterpriseThanks::count()
		);

		return view('admin.dashboard')->with('data', $data);
	}

	/**
	 * Admins's list page
	 *
	 * @return Response
	 */
	public function listAll()
	{
		return view('admin.admin.list');
	}

    /**
	 * Index page
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$admins = Admin::latest()->paginate(10);

		$response = [
            'pagination' => [
                'total' => $admins->total(),
                'per_page' => $admins->perPage(),
                'current_page' => $admins->currentPage(),
                'last_page' => $admins->lastPage(),
                'from' => $admins->firstItem(),
                'to' => $admins->lastItem()
            ],
            'data' => $admins
        ];

        return response()->json($response);
	}
	
	/**
	 *
	 * Store a new admin.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 * 
	 */
    public function store(AdminRequest $request)
    {
    	$findAdmin = Admin::where('email', '=', $request->email)->first();

    	if($findAdmin == null) {
    		$admin = new Admin();
    		$admin->name = $request->name;
    		$admin->email = $request->email;
    		$admin->password = bcrypt($request->password);
	    	$admin->save();

	    	return response()->json($admin);
	    } else 
	    	return false;
	    }    	
    }

    /**
	 *
	 * Show admin data.
	 * 
	 * @param int $id
	 *
	 * @return Admin $admin
	 * 
	 */
    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return $admin;
    }

    /**
	 * Update admin's data
	 * 
	 */
    public function update(AdminRequest $request, $id)
    {
    	$admin = Admin::find($id);

    	$admin->name = $request->name;
    	$admin->email = $request->email;
    	$admin->password = bcrypt($request->password);

    	$admin->save();

        return response()->json($admin);
    }

    /**
	 *
	 * Remove the administrator.
	 * 
	 * @param int $id
	 *
	 * @return Response
	 * 
	 */
    public function destroy($id)
    {
        $delete = Admin::findOrFail($id)->delete();        
        return response()->json($delete);
    }
}
