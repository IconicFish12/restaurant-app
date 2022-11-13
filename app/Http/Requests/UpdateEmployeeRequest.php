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

}
