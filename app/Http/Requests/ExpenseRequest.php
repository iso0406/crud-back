<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;

class ExpenseRequest extends FormRequest
{
    public $validator = null;
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
    public function rules() {
        return [
            'description' => 'required|min:50|max:191',
            'date_expense' => 'required|before:now', 
            'price' => 'required|min:0', 
            'id_user' => 'required', 
        ];
    }

    public function messages() {
        return [
            'description.required' => 'O campo "Descrição" é obrigatório',
            'description.min' => 'O campo "Descrição pode ter no minimo 50 caracteres',
            'description.max' => 'O campo "Descrição pode ter no máximo 191 caracteres',
            'date_expense.required' => 'O campo "Data de despensa" é obrigatório',
            'date_expense.before' => 'O campo "Data de despensa" não aceita datas futuras',
            'price.required' => 'O campo "Preço" é obrigatório',
            'price.min' => 'O campo "Preço" não aceita valor negativo',
            'id_user.required' => 'O campo "id do usuário" é obrigatório',
        ];
    }

    protected function failedValidation(Validator $validator) {
        $this->validator = $validator;
    }
}
