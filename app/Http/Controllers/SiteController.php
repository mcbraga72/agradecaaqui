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
        return view('app.index')->with('data', $data);        
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
        if(empty($request->enterprise)) {        
            $request->session()->put('type', 'userThanks');
            $request->session()->put('userName', $request->userName);
            $request->session()->put('userEmail', $request->userEmail);
            $request->session()->put('content', $request->content);
        } else {
            $request->session()->put('type', 'enterpriseThanks');
            $request->session()->put('enterprise', $request->enterprise);
            $request->session()->put('content', $request->content);
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
