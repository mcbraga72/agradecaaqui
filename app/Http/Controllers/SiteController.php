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
     * Show the about us page
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
     * Show the support us page
     *
     * @return Response
     */
    public function support()
    {
    	return view('site.support');	
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
