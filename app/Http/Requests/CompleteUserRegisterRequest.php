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

    /**
     * Chnage default messages that apply to the request validation.
     *
     * @return array
     */
    public function rules()
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
            'country.required' => 'O campo país é obrigatório!',
            'email.required' => 'O campo email é obrigatório!',
            'email.email' => 'Por favor, digite um e-mail válido!',
            'education.required' => 'O campo escolaridade é obrigatório!',
            'profession.required' => 'O campo profissão é obrigatório!',
            'maritalStatus.required' => 'O campo estado civil é obrigatório!',
            'religion.required' => 'O campo religião é obrigatório!',
            'ethnicity.required' => 'O campo etnia é obrigatório!',
            'income.required' => 'O campo renda familiar é obrigatório!',
            'sport.required' => 'O campo pratica esportes é obrigatório!',
            'soccerTeam.required' => 'O campo time de futebol é obrigatório!',
            'height.required' => 'O campo altura é obrigatório!',
            'weight.required' => 'O campo peso é obrigatório!',
            'hasCar.required' => 'O campo possui automóvel é obrigatório!',
            'hasChildren.required' => 'O campo possui filhos é obrigatório!',
            'liveWith.required' => 'O campo mora com quem é obrigatório!',
            'pet.required' => 'O campo possui animais de estimação é obrigatório!'           
        ];
    }    
}
