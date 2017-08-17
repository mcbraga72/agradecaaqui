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
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',
            'cpf' => 'required_without:cnpj',
            'cnpj' => 'required_without:cpf'            
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
            'neighborhood.required' => 'O campo bairro é obrigatório!',
            'city.required' => 'O campo cidade é obrigatório!',
            'state.required' => 'O campo estado é obrigatório!',
            'cpf.required_without' => 'O campo cpf ou o campo cnpj devem ser preenchidos!',
            'cnpj.required_without' => 'O campo cnpj ou o campo cpf devem ser preenchidos!'            
        ];
    }
}
