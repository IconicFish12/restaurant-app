<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'firstname' => ["required"],
            'lastname' => ["required"],
            'birth' => ['required', 'date'],
            'phone_number' => ["required", "max:15"],
            'username' => ["required", "max:50"],
            'password' => ["required", "min:6"],
            'email' => ["required", "email:dns"],
            'role' => ["required"]
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'firstname.required' => 'A Firstname is required',
            'lastname.required' => 'A Lastname is required',
            'birth.required' => 'A Date of Birth is required',
            'phone_number.required' => 'A Phone Number is required',
            'phone_number.max' => 'Phone number cannot be more than 15',
            'username.required' => 'A Username is required',
            'username.max' => 'Username cannot be more than 50',
            'password.min' => 'password cannot be less than 6',
            'email.required' => 'A Email is required',
            'email.email' => 'Email Must be Verified Email',
            'role.required' => 'A Role is required'
        ];
    }
}
