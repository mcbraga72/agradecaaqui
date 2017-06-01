<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Http\Requests\EnterpriseRequest;
use App\Http\Requests\HomeRequest;
use App\Mail\SiteContactFormMail;
use App\Models\Enterprise;
use App\Models\EnterpriseThanks;
use DB;
use Illuminate\Http\Request;
use Mail;

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
            'enterpriseThanks' => DB::table('enterprise_thanks')->join('enterprises', 'enterprises.id', '=', 'enterprise_thanks.enterprise_id')->select('name', 'content', 'logo')->orderBy('thanksDateTime', 'desc')->take(10)->get()            
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
            session()->put('receiptName', $request->receiptName);
            session()->put('receiptEmail', $request->receiptEmail);
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

    /**
     *
     * Find enterprise and user thanks based in keywords given by the user.
     *
     * @param Request $request
     *
     * @return Response
     * 
     */
    public function findThanks(Request $request)
    {
        $data = array(
            'enterprises' => Enterprise::all(),
            'enterpriseThanks' => DB::table('enterprise_thanks')->join('enterprises', 'enterprises.id', '=', 'enterprise_thanks.enterprise_id')->select('name', 'content', 'logo')->where('content', 'LIKE', "%{$request->search}%")->orderBy('thanksDateTime', 'desc')->get()
        );
        
        return view('site.index')->with('data', $data);
    }

    /**
     *
     * Send messages from site contact form.
     *
     * @param EnterpriseRequest $request
     *
     * @return Response
     * 
     */
    public function sendMessageContactForm(ContactFormRequest $request)
    {
        Mail::to('agradecaaquicontato@gmail.com')->send(new SiteContactFormMail($request->name, $request->email, $request->message));
        return view('site.contact')->withSuccess('E-mail enviado com sucesso!');
    }

    /**
     *
     * Store enterprise's data.
     *
     * @param EnterpriseRequest $request
     *
     * @return Response
     * 
     */
    public function storeEnterprise(EnterpriseRequest $request)
    {       
        $enterprise = new Enterprise();

        $enterprise->category_id = $request->category_id;
        $enterprise->name = $request->name;
        $enterprise->contact = $request->contact;
        $enterprise->email = $request->email;
        $enterprise->site = $request->site;
        $enterprise->telephone = $request->telephone;
        $enterprise->address = $request->address;       
        $enterprise->status = 'Pending';

        if($enterprise->save()) {
            $data = array(
                'enterprises' => Enterprise::all(),
                'enterpriseThanks' => DB::table('enterprise_thanks')->join('enterprises', 'enterprises.id', '=', 'enterprise_thanks.enterprise_id')->select('name', 'content', 'logo')->orderBy('thanksDateTime', 'desc')->take(10)->get(),
                'success' => 'Caso você faça um agradecimento para a empresa que acabou de cadastrar, seu agradecimento ficará pendente até que o cadastro seja aprovado pela nossa equipe.'
            );            
            return redirect('/')->with('data', $data);
        } else {
            $data = array('error' => 'Não foi possível realizar o cadastro. Por favor, tente novamente.');
            return redirect('/')->withErrors($data);
        }    
    }
}
