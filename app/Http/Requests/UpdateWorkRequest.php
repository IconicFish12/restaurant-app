<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWorkRequest extends FormRequest
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
            "employee_id" => [Rule::requiredIf(auth('admin')->check())],
            "job_desk" => [Rule::requiredIf(auth('admin')->check()), "max:100", "min:10"],
            "job_done" => [Rule::requiredIf(auth('employee')->check() and request()->has('job_done'))]
        ];
    }
}
