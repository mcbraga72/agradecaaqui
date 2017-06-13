<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{

    /**
     * User's list page
     *
     * @return Response
     */
    public function list()
    {
        return view('admin.user.list');
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
    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->surName = $request->surName;
        $user->gender = $request->gender;
        $user->dateOfBirth = $request->dateOfBirth;
        $user->telephone = $request->telephone;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

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
