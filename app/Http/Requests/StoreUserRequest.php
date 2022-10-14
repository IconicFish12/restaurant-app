<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'username' => ["required", "max:50", "unique:users"],
            'password' => ["required", "min:6", "confirmed", "unique:users"],
            'email' => ["required", "email:dns", "unique:users"]
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
            'username.unique' => 'Username Must Unique',
            'username.max' => 'Username cannot be more than 50',
            'password.required' => "A Password is required",
            'password.min' => 'password cannot be less than 6',
            'email.required' => 'A Email is required',
            'email.email' => 'Email Must be Verified Email',
            'email.unique' => 'Email Must Unique'
        ];
    }
}
