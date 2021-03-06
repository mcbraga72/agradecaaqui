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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
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
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->registerType = 'Padrão';

        if(isset($data['photo'])) {
            copy($data['photo'], '/images/photos/' . $data['email'] . '.png');
            $user->photo = '/images/photos/' . $data['email'] . '.png';
        } else {
            if(isset($data['gender'])) {
                if($data['gender'] == 'male') {
                    $user->photo = '/images/male.png';
                } else {
                    $user->photo = '/images/female.png';
                }
            } else {
                $user->photo = 'images/user.png';
            }
        }

        if($user->save()) {
            $providerUser = new SocialAccountService;
            $providerUser->createSocialAccount($user);
        }    
        
        return $user;
    }
}
