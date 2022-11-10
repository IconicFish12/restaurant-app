<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            "name" => ["required"],
            "birth" => ["required", "date"],
            "age" => ["required","integer","max:60"],
            "phone_number" => ["required","max:13","unique:employees"],
            "position" => ["required"],
            "email" => ["required","email:dns","unique:employees"],
            "status" => ["required"],
            'password' => ["required", "min:6", "unique:users"],
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
            'name.required' => 'A Employee Name is required',
            'status.required' => 'A Employee Status is required',
            'birth.unique' => 'A birth is required',
            'age.required' => "A Employee Age is required",
            'age.integer' => 'Age Must be a number',
            'phone_number.required' => 'A Phone Number is required',
            'phone_number.max' => 'Phone number cannot be more than 15',
            "position.required" => "A Employee Position is required",
            'password.required' => "A Password is required",
            'password.min' => 'Password cannot be less than 6',
            "email.required" => "A Email is required",
        ];
    }
}
