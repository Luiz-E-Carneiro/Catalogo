<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    { 
        /* CASO HOUVER Update de user
        
        $isUpdate = $this->get('is_update', false);

        $rules = [
                'name' => ['required', 'string', 'max:255'],
                'email'=> ['required', 'email', Rule::unique('users')->ignore($this->user()->id)],
                'password' => ['required'],
            ];
        */
        $isLogon = $this->boolean('is_logon');

        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required']
        ];
        if ($isLogon){
            $rules["name"] = ['required', "min:5", "max:25"];
            $rules["email"] = ['required', 'email', 'unique:users,email'];
            $rules["password"] = ['required', "confirmed", Password::min(8)->letters()->numbers()];
        }

        return $rules;
    }
}
