<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserThanksRequest extends FormRequest
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
            'receiptName' => 'required',
            'receiptEmail' => 'required|email',
            'content' => 'required'
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
            'receiptName.required' => 'O campo nome é obrigatório!',
            'receiptEmail.required' => 'O campo email é obrigatório!',
            'receiptEmail.email' => 'Por favor, digite um e-mail válido!',
            'content.required' => 'O campo agradecimento é obrigatório!'
        ];
    }
}
