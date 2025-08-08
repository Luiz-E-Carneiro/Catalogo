<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
                'email'=> ['requeired', 'email', Rule::unique('users')->ignore($this->user()->id)],
                'password' => ['required'],
            ];
        */
        $isLogon = $this->get('is_logon', false);

        $rules = [];

        if($isLogon){
            $rules = [
                'name' => ['required', 'string', 'max:255'],
                'email'=> ['requeired', 'email', 'unique:users,email'],
                'password' => ['required', 'confirmed'],
            ];
        } else {
            $rules = [
                'email' => ['required', 'email'],
                'password' => ['required']
            ];
        }

        return $rules;
    }
}
