<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Http\Requests\EnterpriseRequest;
use App\Http\Requests\HomeRequest;
use App\Http\Requests\SiteEnterpriseRegisterRequest;
use App\Mail\SiteContactFormMail;
use App\Mail\EnterpriseRegisterMail;
use App\Mail\AdminApproveEnterpriseRegisterMail;
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
            'enterpriseThanks' => DB::table('enterprise_thanks')->join('enterprises', 'enterprises.id', '=', 'enterprise_thanks.enterprise_id')->join('users', 'users.id', '=', 'enterprise_thanks.user_id')->select('users.name AS user', 'photo', 'enterprises.name AS enterprise', 'content', 'logo', DB::raw('DATE_FORMAT(thanksDateTime, "%d/%m/%Y") AS date'))->orderBy('thanksDateTime', 'desc')->take(10)->get(),
            'page' => 'index'
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
     * Show the ranking page
     *
     * @return Response
     */
    public function ranking()
    {
        $topCategories = DB::table('enterprise_thanks')->join('enterprises', 'enterprises.id', '=', 'enterprise_thanks.enterprise_id')->join('categories', 'categories.id', '=', 'enterprises.category_id')->select('categories.name AS category', DB::raw('count(*) AS thanks'))->groupBy('categories.name')->orderBy('thanks', 'desc')->take(10)->get();

        foreach ($topCategories as $topCategory) {
            $enterprisesRankingByCategories[] = DB::table('enterprise_thanks')->join('enterprises', 'enterprises.id', '=', 'enterprise_thanks.enterprise_id')->join('categories', 'categories.id', '=', 'enterprises.category_id')->select('categories.name', 'enterprises.name AS enterprise', DB::raw('count(*) AS thanks'), 'enterprises.logo AS logo')->where('categories.name', '=', $topCategory->category)->groupBy('enterprises.name')->orderBy('thanks', 'desc')->take(10)->get();
        }

        $data = array(
            'enterprisesRanking' => DB::table('enterprise_thanks')->join('enterprises', 'enterprises.id', '=', 'enterprise_thanks.enterprise_id')->select('enterprises.name AS enterprise', DB::raw('count(*) AS thanks'), 'enterprises.logo AS logo')->groupBy('enterprises.name')->orderBy('thanks', 'desc')->take(10)->get(),
            'categoriesRanking' => DB::table('enterprise_thanks')->join('enterprises', 'enterprises.id', '=', 'enterprise_thanks.enterprise_id')->join('categories', 'categories.id', '=', 'enterprises.category_id')->select('categories.name AS category', DB::raw('count(*) AS thanks'))->groupBy('categories.name')->orderBy('thanks', 'desc')->take(10)->get(),
            'enterprisesRankingByCategories' => collect($enterprisesRankingByCategories)
        );

        return view('site.thanks-ranking')->with('data', $data);
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
            'enterpriseThanks' => DB::table('enterprise_thanks')->join('enterprises', 'enterprises.id', '=', 'enterprise_thanks.enterprise_id')->join('users', 'users.id', '=', 'enterprise_thanks.user_id')->select('users.name AS user', 'photo', 'enterprises.name AS enterprise', 'content', 'logo', DB::raw('DATE_FORMAT(thanksDateTime, "%d/%m/%Y") AS date'))->where('enterprise_thanks.content', 'LIKE', "%{$request->search}%")->orWhere('enterprises.name', 'LIKE', "%{$request->search}%")->orderBy('thanksDateTime', 'desc')->get(),
            'page' => 'search'
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
    public function storeEnterprise(SiteEnterpriseRegisterRequest $request)
    {       
        $enterprise = new Enterprise();

        $enterprise->category_id = $request->category_id;
        $enterprise->name = $request->name;
        $enterprise->contact = $request->contact;
        $enterprise->email = $request->email;
        $enterprise->site = $request->site;
        $enterprise->telephone = $request->telephone;
        $enterprise->address = $request->address;
        $enterprise->neighborhood = $request->neighborhood;
        $enterprise->city = $request->city;
        $enterprise->state = $request->state;
        $enterprise->cpf = $request->cpf;
        $enterprise->cnpj = $request->cnpj;
        $enterprise->status = 'Pending';

        if($enterprise->save()) {
            $data = array(
                'enterprises' => Enterprise::all(),
                'enterpriseThanks' => DB::table('enterprise_thanks')->join('enterprises', 'enterprises.id', '=', 'enterprise_thanks.enterprise_id')->join('users', 'users.id', '=', 'enterprise_thanks.user_id')->select('users.name AS user', 'photo', 'enterprises.name AS enterprise', 'content', 'logo', DB::raw('DATE_FORMAT(thanksDateTime, "%d/%m/%Y") AS date'))->orderBy('thanksDateTime', 'desc')->take(10)->get(),
                'page' => 'index',
                'success' => 'Caso você faça um agradecimento para a empresa que acabou de cadastrar, seu agradecimento ficará pendente até que o cadastro seja aprovado pela nossa equipe.'
            );

            Mail::to('agradecaaquicontato@gmail.com')->send(new AdminApproveEnterpriseRegisterMail($request->name));
            
            return redirect('/')->with('data', $data);
        } else {
            $data = array(
                'enterprises' => Enterprise::all(),
                'enterpriseThanks' => DB::table('enterprise_thanks')->join('enterprises', 'enterprises.id', '=', 'enterprise_thanks.enterprise_id')->join('users', 'users.id', '=', 'enterprise_thanks.user_id')->select('users.name AS user', 'photo', 'enterprises.name AS enterprise', 'content', 'logo', DB::raw('DATE_FORMAT(thanksDateTime, "%d/%m/%Y") AS date'))->orderBy('thanksDateTime', 'desc')->take(10)->get(),
                'page' => 'index',
                'error' => 'Não foi possível realizar o cadastro. Por favor, tente novamente.'
            );
            return redirect('/')->with('data', $data);
        }    
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
    public function enterpriseRegister(EnterpriseRequest $request)
    {       
        $enterprise = new Enterprise();

        $enterprise->category_id = $request->category_id;
        $enterprise->name = $request->name;
        $enterprise->contact = $request->contact;
        $enterprise->email = $request->email;
        $enterprise->site = $request->site;
        $enterprise->telephone = $request->telephone;
        $enterprise->address = $request->address;
        $enterprise->neighborhood = $request->neighborhood;
        $enterprise->city = $request->city;
        $enterprise->state = $request->state;
        $enterprise->cpf = $request->cpf;
        $enterprise->cnpj = $request->cnpj;
        $enterprise->status = 'Pending';

        if($enterprise->save()) {
            Mail::to($request->email)->send(new EnterpriseRegisterMail());

            Mail::to('agradecaaquicontato@gmail.com')->send(new AdminApproveEnterpriseRegisterMail($request->name));
            
            return view('site.contact')->withSuccess('Seu cadastro será avaliado pela nossa equipe e será aprovado em breve!');
        } else {
            return view('site.contact')->withErrors('Não foi possível realizar o cadastro. Por favor, tente novamente.');
        }
    }
}
