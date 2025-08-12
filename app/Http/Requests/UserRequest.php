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
    public function authorize(): bool {
        return true;
    }

    protected function prepareForValidation() {
        $this->merge([
            'is_logon' => $this->routeIs('auth.logon')
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules() {
        $isLogon = $this->boolean('is_logon');
        $rules = [];

        if ($isLogon) {
            $rules = [
                "name" => ['required', "min:4", "max:25"],
                "email" => ['required', 'email', 'unique:users,email'],
                "password" => ['required', "confirmed", Password::min(8)->letters()->numbers()]
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
