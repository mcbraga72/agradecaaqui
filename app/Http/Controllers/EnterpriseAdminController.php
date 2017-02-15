<?php

namespace App\Http\Controllers;

use App\Models\Enterprise;
use Illuminate\Http\Requests\EnterpriseRequest;

class EnterpriseAdminController extends Controller
{
    /**
	 *
	 * Show enterprise's list.
	 *
	 * @return Response
	 * 
	 */
    public function index()
    {
    	$enterprises = Enterprise::all();
    	return view('admin.enterprise.list')->with('enterprises', $enterprises);
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
    	return view('admin.enterprise.create');
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
    public function store(EnterpriseRequest $request)
    {
    	$enterprise = new Enterprise();

    	$enterprise->name = $request->name;
    	$enterprise->site = $request->site;
    	$enterprise->email = $request->email;

    	$enterprise->save();

    	$enterprises = Enterprise::all();
    	return view('admin.enterprise.list')->with('enterprises', $enterprises);
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
    	return view('admin.enterprise.profile', ['user' => Enterprise::findOrFail($id)]);
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
    	return view('admin.enterprise.profile', ['user' => Enterprise::findOrFail($id)]);
    }

    /**
	 *
	 * Update enterprise's data.
	 *
	 * @param int $id
	 *
	 * @return Response
	 * 
	 */
    public function update(EnterpriseRequest $request, $id)
    {
    	$enterprise = Enterprise::find($id);

    	$enterprise->name = $request->name;
    	$enterprise->site = $request->site;
    	$enterprise->email = $request->email;

    	$enterprise->save();

    	$enterprises = Enterprise::all();
    	return view('admin.enterprise.list')->with('enterprises', $enterprises);
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
    	$enterprise = Enterprise::findOrFail($id);
    	$enterprise->delete();

    	$enterprises = Enterprise::all();
    	return view('admin.enterprise.list')->with('enterprises', $enterprises);
    }
}
