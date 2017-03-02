<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\Admin;
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
	 * Login page
	 *
	 * @return Response
	 */
	public function index()
	{
		//$admins = Admin::all();
		//return view('admin.admin.list')->with('admins', $admins);
		
		$items = Admin::latest()->paginate(5);

		$response = [
            'pagination' => [
                'total' => $items->total(),
                'per_page' => $items->perPage(),
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'from' => $items->firstItem(),
                'to' => $items->lastItem()
            ],
            'data' => $items
        ];

        return response()->json($response);
	}

	/**
	 * Dashboard page
	 *
	 * @return Response
	 */
	public function dashboard()
	{
		return view('admin.dashboard');
	}

	/**
	 *
	 * Show the form to create a new admin
	 *
	 * @return Response
	 * 
	 */
    public function create()
    {    	
    	return view('admin.admin.create');
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
    	$admin = new Admin();

    	$admin->name = $request->name;
    	$admin->email = $request->email;
    	$admin->password = bcrypt($request->password);

    	$admin->save();

    	$admins = Admin::all();
    	return view('admin.admin.list')->with('admins', $admins);
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
	 *
	 * Shows edit profile's page
	 * 
	 * @return Response
	 * 
	 */
    public function edit($id)
    {
    	$admin = Admin::findOrFail($id);
    	return view('admin.admin.profile')->with('admin', $admin);
    }

    /**
	 * Update admin's data
	 * 
	 */
    public function update(AdminRequest $request)
    {
    	$admin = new Admin();

    	$admin->name = $request->name;
    	$admin->email = $request->email;        
    	
    	$admin->save();

    	$admins = Admin::all();
    	return view('admin.admin.list')->with('admins', $admins);
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
        $admin = Admin::findOrFail($id);
        $admin->delete();

        $admins = Admin::all();
    	return view('admin.admin.list')->with('admins', $admins);
    }
}
