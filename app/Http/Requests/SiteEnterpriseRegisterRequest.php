<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteEnterpriseRegisterRequest extends FormRequest
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
            'name' => 'required'            
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
        ];
    }
}
