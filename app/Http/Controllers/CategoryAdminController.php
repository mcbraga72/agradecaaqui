<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryAdminController extends Controller
{
	/**
	 * Categories's list page
	 *
	 * @return Response
	 */
	public function listAll()
	{
		return view('admin.category.list');
	}

    /**
	 * Index page
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$categories = Category::orderBy('name')->paginate(10);
		
		$response = [
            'pagination' => [
                'total' => $categories->total(),
                'per_page' => $categories->perPage(),
                'current_page' => $categories->currentPage(),
                'last_page' => $categories->lastPage(),
                'from' => $categories->firstItem(),
                'to' => $categories->lastItem()
            ],
            'data' => $categories
        ];

        return response()->json($response);
	}
	
	/**
	 *
	 * Store a new category.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 * 
	 */
    public function store(CategoryRequest $request)
    {
    	$findCategory = Category::where('name', '=', $request->name)->first();

    	if($findCategory == null) {
    		$category = new Category();
	    	$category->name = $request->name;
    		$category->save();

    		return response()->json($category);    		
    	} else {
    		return false;
    	}
    }

    /**
	 *
	 * Show category data.
	 * 
	 * @param int $id
	 *
	 * @return Category $category
	 * 
	 */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return $category;
    }

    /**
	 * Update category's data
	 * 
	 */
    public function update(CategoryRequest $request, $id)
    {
    	$category = Category::find($id);
    	$category->name = $request->name;
    	$category->save();

        return response()->json($category);
    }

    /**
	 *
	 * Remove the category.
	 * 
	 * @param int $id
	 *
	 * @return Response
	 * 
	 */
    public function destroy($id)
    {
        $delete = Category::findOrFail($id)->delete();        
        return response()->json($delete);
    }
}
