<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|between:8,255|confirmed'
        ];
    }

    /**
     * Chnage default messages that apply to the request validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório!',
            'surName.required' => 'O campo sobrenome é obrigatório!',
            'gender.required' => 'O campo sexo é obrigatório!',
            'dateOfBirth.required' => 'O campo cidade é obrigatório!',
            'dateOfBirth.before' => 'Para se cadastrar em nosso site, você deve ter no mínimo 13 anos de idade.',
            'telephone.required' => 'O campo celular é obrigatório!',
            'city.required' => 'O campo cidade é obrigatório!',
            'state.required' => 'O campo estado é obrigatório!',            
            'email.required' => 'O campo email é obrigatório!',
            'email.email' => 'Por favor, digite um e-mail válido!',
            'password.required' => 'O campo senha é obrigatório!',
            'password.between' => 'Sua senha deve possuir pelo menos 8 caracteres!'
        ];
    }
}
