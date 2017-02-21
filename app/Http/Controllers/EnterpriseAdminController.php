<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Enterprise;
use App\Http\Requests\EnterpriseRequest;

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
    	$categories = Category::all();
    	return view('admin.enterprise.create')->with('categories', $categories);
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
    	$enterprise->cnpj = $request->cnpj;
    	$enterprise->address = $request->address;
    	$enterprise->telephone = $request->telephone;
    	$enterprise->site = $request->site;
    	$enterprise->email = $request->email;
        $enterprise->status = 'Approved';

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
	 * @return Enterprise $enterprise
	 * 
	 */
    public function show($id)
    {
    	$enterprise = Enterprise::findOrFail($id);
        return $enterprise;
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
    	$enterprise->cnpj = $request->cnpj;
    	$enterprise->address = $request->address;
    	$enterprise->telephone = $request->telephone;
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
