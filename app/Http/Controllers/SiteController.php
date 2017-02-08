<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Show the index page
     *
     * @return Response
     */
    public function index()
    {
    	return view('site.index');    	
    }

    /**
     * Show the about page
     *
     * @return Response
     */
    public function about()
    {
    	return view('site.about');	
    }

    /**
     * Show the contact page
     *
     * @return Response
     */
    public function contact()
    {
    	return view('site.contact');	
    }

    /**
     * Show the rules page
     *
     * @return Response
     */
    public function rules()
    {
    	return view('site.rules');	
    }

    /**
     * Show the login page
     *
     * @return Response
     */
    public function login()
    {
    	return view('site.login');	
    }
}
