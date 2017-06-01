<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompleteUserRegisterRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use URL;

class UserAppController extends Controller
{    
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

        $user->save();
        
        return response()->json($user);
    }

    /**
     *
     * Edit user's data.
     * 
     * @param int $id
     *
     * @return User $user
     * 
     */
    public function edit($id)
    {
        $countriesList = new \SplFileObject(URL::to('/') . '/paises.json');

        while (!$countriesList->eof()) {
            $countries[] = trim($countriesList->fgets());
        }

        $user = Auth::user();
        return view('app.profile')->with('countries', $countries);
    }

    /**
	 *
	 * Update user's data.
	 *
	 * @param Request $request
	 * @param int $id
	 *
	 * @return Response
	 * 
	 */
    public function update(CompleteUserRegisterRequest $request, $id)
    {
        $user = User::find($id);

    	$user->name = $request->name;
    	$user->surName = $request->surName;
        $user->gender = $request->gender;
        $user->dateOfBirth = $request->dateOfBirth;
        $user->telephone = $request->telephone;
        $user->city = $request->city;
        $user->state = $request->state;    	
        $user->country = $request->country;
        $user->email = $request->email;
        $user->education = $request->education;
        $user->profession = $request->profession;
        $user->maritalStatus = $request->maritalStatus;
        $user->religion = $request->religion;
        $user->ethnicity = $request->ethnicity;
        $user->income = $request->income;        
        $user->sport = implode(' ', $request->sport);
        $user->soccerTeam = $request->soccerTeam;
        $user->height = $request->height;
        $user->weight = $request->weight;
        $user->hasCar = $request->hasCar;
        $user->hasChildren = $request->hasChildren;
        $user->liveWith = $request->liveWith;
        $user->pet = implode(' ', $request->pet);
        $user->registerType = 'Complete';

        if(!is_null($request->photo)) {
            $currentPhoto = $this->getCurrentPhoto(Auth::user()->id);
            Storage::delete($currentPhoto);
            $photo = $request->file('photo');
            $filename = Auth::user()->email . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)->resize(40, 40)->save(public_path() . '/images/photos/' . $filename);
            $user->photo = '/images/photos/' . $filename;
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
