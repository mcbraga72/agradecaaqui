<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnterpriseThanks;

class SiteController extends Controller
{
    /**
     * Show the index page
     *
     * @return Response
     */
    public function index()
    {
        $enterpriseThanks = EnterpriseThanks::orderBy('date', 'desc')->take(9)->get();
    	return view('site.index')->with('enterpriseThanks', $enterpriseThanks);    	
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

    /**
     * Show the register page
     *
     * @return Response
     */
    public function register()
    {
        return view('site.register');  
    }
}
