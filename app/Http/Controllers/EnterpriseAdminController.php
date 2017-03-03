<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Enterprise;
use App\Http\Requests\EnterpriseRequest;
use Illuminate\Http\Request;

class EnterpriseAdminController extends Controller
{

    /**
     * Enterprises's list page
     *
     * @return Response
     */
    public function list()
    {
        return view('admin.enterprise.list');
    }

    /**
     * Index page
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $enterprises = Enterprise::latest()->paginate(5);
        $categories = Category::all();

        $response = [
            'pagination' => [
                'total' => $enterprises->total(),
                'per_page' => $enterprises->perPage(),
                'current_page' => $enterprises->currentPage(),
                'last_page' => $enterprises->lastPage(),
                'from' => $enterprises->firstItem(),
                'to' => $enterprises->lastItem()
            ],
            'data' => $enterprises,
            'categories' => $categories
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
    public function store(EnterpriseRequest $request)
    {
        $enterprise = new Enterprise();

        $enterprise->category_id = $request->category_id;
        $enterprise->name = $request->name;
        $enterprise->contact = $request->contact;
        $enterprise->email = $request->email;        
        $enterprise->telephone = $request->telephone;
        $enterprise->address = $request->address;
        $enterprise->status = 'Approved';
        $enterprise->password = bcrypt(str_random(8));

        $enterprise->save();
        
        return response()->json($enterprise);
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
     * Update enterprise's data
     * 
     */
    public function update(EnterpriseRequest $request, $id)
    {
        $enterprise = Enterprise::find($id);

        $enterprise->category_id = $request->category_id;
        $enterprise->name = $request->name;
        $enterprise->contact = $request->contact;
        $enterprise->email = $request->email;        
        $enterprise->telephone = $request->telephone;
        $enterprise->address = $request->address;        

        $enterprise->save();

        return response()->json($enterprise);
    }

    /**
     *
     * Remove the enterprise.
     * 
     * @param int $id
     *
     * @return Response
     * 
     */
    public function destroy($id)
    {
        $delete = Enterprise::findOrFail($id)->delete();        
        return response()->json($delete);
    }
    
}
