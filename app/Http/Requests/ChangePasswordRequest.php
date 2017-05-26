<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'password.required' => 'O campo senha é obrigatório!',
            'password.between' => 'Sua senha deve possuir pelo menos 8 caracteres!',
            'password.confirmed' => 'Os campos senha e confirmar senha devem possuir valores idênticos!'
        ];
    }
}
