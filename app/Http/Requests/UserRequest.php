<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ];
    }

    public function messages() {
        return [
            'name.required'             => 'O campo "name" é obrigatório',
            'email.required'            => 'O campo "email" é obrigatório',
            'email.unique'              => 'O email já existe',
            'password.required'         => 'O campo "password" é obrigatório',
            'c_password.required'       => 'O campo "c_password" é obrigatório',
            'c_password.same'           => 'As senhas não coincidem',
        ];
    }

    protected function failedValidation(Validator $validator) {
        $this->validator = $validator;
    }
}
