<?php

namespace App\Http\Controllers\EnterpriseAuth;

use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/empresa/painel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'category_id' => 'required',
            'name' => 'required|max:255',
            'contact' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'telephone' => 'required',
            'address' => 'required',
            'password' => 'required|min:6',
            'password-confirm' => 'required|min:6|same:password'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'category_id' => $data['category_id'], 
            'name' => $data['name'],            
            'contact' => $data['contact'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'address' => $data['address'],
            'password' => bcrypt($data['password']),
            'status' => 'Pending'
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $categories = Category::all();
        return view('enterprise-auth.register')->with('categories', $categories);
    }
}
