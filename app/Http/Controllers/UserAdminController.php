<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\CompleteUserRegisterRequest;
use Illuminate\Http\Request;
use URL;

class UserAdminController extends Controller
{

    /**
     * User's list page
     *
     * @return Response
     */
    public function listAll()
    {
        $countriesList = new \SplFileObject(URL::to('/') . '/paises.json');

        while (!$countriesList->eof()) {
            $countries[] = trim($countriesList->fgets());
        }
        
        return view('admin.user.list')->with('countries', $countries);
    }

    /**
     * Index page
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('name')->paginate(10);
        
        $response = [
            'pagination' => [
                'total' => $users->total(),
                'per_page' => $users->perPage(),
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'from' => $users->firstItem(),
                'to' => $users->lastItem()
            ],
            'data' => $users        
        ];

        return response()->json($response);
    }
    
    /**
     *
     * Add new user to the database.
     *
     * @param Request $request
     *
     * @return Response
     * 
     */
    public function store(UserRequest $request)
    {
        $findUser = User::where('email', '=', $request->email)->first();

        if($findUser == null) {
            $user = new User();

            $user->name = $request->name;
            $user->surName = $request->surName;
            $user->gender = $request->gender;
            $user->dateOfBirth = $request->dateOfBirth;
            $user->telephone = $request->telephone;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->registerType = 'Padrão';

            if($request->gender == 'Masculino') {
                $user->photo = '/images/male.png';
            } else {
                $user->photo = '/images/female.png';
            }

            $user->save();
            
            return response()->json($user);
        } else {
            return false;
        }
    }

    /**
     *
     * Show user's data.
     * 
     * @param int $id
     *
     * @return User $user
     * 
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    /**
     * Update user's data
     * 
     */
    public function update(CompleteUserRegisterRequest $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->surName = $request->surName;

        if ($request->gender == 'Outro') {
            $user->gender = $request->otherGender;            
        } else {
            $user->gender = $request->gender;
        }
        
        $user->dateOfBirth = $request->dateOfBirth;
        $user->telephone = $request->telephone;
        $user->city = $request->city;
        $user->state = $request->state;     
        $user->country = $request->country;
        $user->email = $request->email;
        $user->education = $request->education;
        $user->profession = $request->profession;
        $user->maritalStatus = $request->maritalStatus;
        
        if ($request->religion == 'Outra') {
            $user->religion = $request->otherReligion;
        } else {
            $user->religion = $request->religion;            
        }
        
        $user->income = $request->income;

        if (in_array('Outro(s)', $request->sport)) {
            $user->sport = $request->otherSport;
        } else {
            $user->sport = json_encode($request->sport);            
        }

        if ($request->soccerTeam == 'Outro') {
            $user->soccerTeam = $request->otherSoccerTeam;
        } else {
            $user->soccerTeam = $request->soccerTeam;
        }

        $user->height = $request->height;
        $user->weight = $request->weight;
        $user->hasCar = $request->hasCar;
        $user->hasChildren = $request->hasChildren;
        $user->liveWith = $request->liveWith;
        
        if (in_array('Outro(s)', $request->pet)) {
            $user->pet = $request->otherPet;
        } else {
            $user->pet = json_encode($request->pet);
        }

        $user->save();

        return response()->json($user);
    }

    /**
     *
     * Remove the user.
     * 
     * @param int $id
     *
     * @return Response
     * 
     */
    public function destroy($id)
    {
        $delete = User::findOrFail($id)->delete();        
        return response()->json($delete);
    }
    
}
