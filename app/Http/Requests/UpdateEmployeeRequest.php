<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
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
            "name" => [Rule::requiredIf(request()->has('name'))],
            "birth" => [Rule::requiredIf(request()->has('birth')), "date"],
            "age" => [Rule::requiredIf(request()->has('age')),"integer","max:60"],
            "phone_number" => [Rule::requiredIf(request()->has('phone_number')),"max:13"],
            "position" => [Rule::requiredIf(request()->has('position'))],
            "email" => [Rule::requiredIf(request()->has('email')),"email:dns"],
            "employe_code"  => [Rule::requiredIf(request()->has('employee_code')), "unique:employees", "max:20"],
            'password' => [Rule::requiredIf(request()->has('password')), "min:6"],
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
            "employee_code.required" => "A Employee Code is required",
            "employee_code.unique" => "Employee Code Must Unique",
            "employee_code.max" => "Employee Code cannot be more than 20",
            'password.required' => "A Password is required",
            'password.min' => 'Password cannot be less than 6',
        ];
    }
}
