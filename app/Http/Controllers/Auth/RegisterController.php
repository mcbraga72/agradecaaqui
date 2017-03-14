<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SocialAccountService;
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
    protected $redirectTo = '/app';

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
            'name' => 'required|max:255',
            'surName' => 'required',
            'gender' => 'required',
            'dateOfBirth' => 'required|before:13 years ago',
            'telephone' => 'required',
            'city' => 'required',
            'state' => 'required',
            'email' => 'required|email|max:255|unique:users',
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
        $user = new User();

        $user->name = $data['name'];
        $user->surName = $data['surName'];
        $user->gender = $data['gender'];
        $user->dateOfBirth = $data['dateOfBirth'];
        $user->telephone = $data['telephone'];
        $user->email = $data['email'];
        $user->city = $data['city'];
        $user->state = $data['state'];
        $user->password = bcrypt($data['password']);

        $user->save();

        if(isset($data['id'])) {
            $providerUser = new SocialAccountService;
            $providerUser->createSocialAccount($user, $data['id']);
        }    
        
        return $user;
    }
}
