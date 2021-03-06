<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|between:8,12|same:passwordConfirm'
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
            'email.required' => 'O campo email é obrigatório!',
            'email.email' => 'Por favor, digite um e-mail válido!',
            'password.required' => 'O campo senha é obrigatório!',
            'password.between' => 'Sua senha deve possuir no mínimo 8 e no máximo 12 caracteres!',
            'password.confirmed' => 'Os campos senha e confirmar senha devem possuir valores idênticos!'
        ];
    }
}
