<?php

namespace App\Http\Requests;

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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:255', 'string'],
            'email' => ['required', 'max:255', 'email', 'unique:users'],
            'role' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter your name in this field...',
            'name.string' => 'Name field should be in string type...',
            'email.required' => 'Please enter you email in this field...',
            'email.email' => 'Enter valid email please...',
            'email.unique' => 'This email is already exists...',
            'role.required' => 'Please choose role it is mandatory...',
        ];
    }
}
