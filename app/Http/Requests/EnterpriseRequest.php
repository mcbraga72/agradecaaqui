<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnterpriseRequest extends FormRequest
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
            'category_id' => 'required',
            'name' => 'required',
            'contact' => 'required',
            'email' => 'required|email',
            'site' => 'required',
            'telephone' => 'required',
            'address' => 'required',
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
            'category_id.required' => 'Por favor, selecione uma categoria!',
            'name.required' => 'O campo nome é obrigatório!',
            'contact.required' => 'O campo contato é obrigatório!',
            'email.required' => 'O campo email é obrigatório!',
            'email.email' => 'Por favor, digite um e-mail válido!',
            'site.required' => 'O campo site é obrigatório!',
            'telephone.required' => 'O campo celular é obrigatório!',
            'address.required' => 'O campo endereço é obrigatório!',
            'password.required' => 'O campo senha é obrigatório!',
            'password.between' => 'Sua senha deve possuir no mínimo 8 e no máximo 12 caracteres!',
            'password.confirmed' => 'Os campos senha e confirmar senha devem possuir valores idênticos!'
        ];
    }
}
