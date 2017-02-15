<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryAdminController extends Controller
{
	/**
	 *
	 * Show category's list.
	 *
	 * @return Response
	 * 
	 */
    public function index()
    {
    	$categories = Category::all();
    	return view('admin.category.list')->with('categories', $categories);
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
    	return view('admin.category.create');
    }

    /**
	 *
	 * Add new category to the database.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 * 
	 */
    public function store(CategoryRequest $request)
    {
    	$category = new Category();

    	$category->name = $request->name;

    	$category->save();

    	$categories = Category::all();
    	return view('admin.category.list')->with('categories', $categories);
    }

    /**
	 *
	 * Show category data.
	 * 
	 * @param int $id
	 *
	 * @return Response
	 * 
	 */
    public function show($id)
    {
    	return view('admin.category.profile', ['category' => Category::findOrFail($id)]);
    }

    /**
	 *
	 * Edit category data.
	 *
	 * @param int $id
	 *
	 * @return Response
	 * 
	 */
    public function edit($id)
    {
    	return view('admin.category.profile', ['category' => Category::findOrFail($id)]);
    }

    /**
	 *
	 * Update category's data.
	 *
	 * @param int $id
	 *
	 * @return Response
	 * 
	 */
    public function update(CategoryRequest $request, $id)
    {
    	$category = Category::find($id);

    	$category->name = $request->name;

    	$category->save();

    	$categories = Category::all();
    	return view('admin.category.list')->with('categories', $categories);
    }

    /**
	 *
	 * Delete the category.
	 *
	 * @param int $id
	 *
	 * @return Response
	 * 
	 */
    public function destroy($id)
    {
    	$category = Category::findOrFail($id);
    	$category->delete();

    	$categories = Category::all();
    	return view('admin.category.list')->with('categories', $categories);
    }
}
