<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnterpriseThanksRequest extends FormRequest
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
            'enterprise_id' => 'required',
            'contentEnterprise' => 'required'
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
            'enterprise_id.required' => 'Por favor, selecione uma empresa!',
            'content.required' => 'O campo agradecimento é obrigatório!'
        ];
    }
}
