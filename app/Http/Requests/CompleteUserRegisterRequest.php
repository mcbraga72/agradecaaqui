<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompleteUserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'surName' => 'required',
            'gender' => 'required',
            'dateOfBirth' => 'required|before:13 years ago',
            'telephone' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'email' => 'required|email',
            'education' => 'required',
            'profession' => 'required',
            'maritalStatus' => 'required',
            'religion' => 'required',
            'ethnicity' => 'required',
            'income' => 'required',
            'sport' => 'required',
            'soccerTeam' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'hasCar' => 'required',
            'hasChildren' => 'required',
            'liveWith' => 'required',
            'pet' => 'required'            
        ];
    }
}
