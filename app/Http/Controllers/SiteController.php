<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeRequest;
use App\Models\Enterprise;
use App\Models\EnterpriseThanks;
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
        $data = array(
            'enterprises' => Enterprise::all(),
            'enterpriseThanks' => EnterpriseThanks::orderBy('thanksDateTime', 'desc')->take(9)->get()
        );
        return view('site.index')->with('data', $data);        
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
     * Show the login page and put data into session
     *
     * @return Response
     */
    public function loginWithData(HomeRequest $request)
    {
        if(is_null($request->enterprise_id)) {        
            session()->put('type', 'userThanks');
            session()->put('userName', $request->userName);
            session()->put('userEmail', $request->userEmail);
            session()->put('content', $request->content);
        } else {
            session()->put('type', 'enterpriseThanks');
            session()->put('enterprise_id', $request->enterprise_id);
            session()->put('content', $request->content);
        }        
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
