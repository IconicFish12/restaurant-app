<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            "phone_number" => ["required","max:13"],
            "position" => ["required"],
            "email" => ["required","email:dns"]
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
            'birth.unique' => 'A birth is required',
            'age.required' => "A Employee Age is required",
            'age.integer' => 'Age Must be a number',
            'phone_number.required' => 'A Phone Number is required',
            'phone_number.max' => 'Phone number cannot be more than 15',
            "position.required" => "A Employee Position is required",
            "email.required" => "A Email is required",
        ];
    }
}
