<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePerformanceRequest extends FormRequest
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
            "employee_id" => [Rule::requiredIf(request()->has("employee_id") and auth('admin')->check())],
            "date" => [Rule::requiredIf(request()->has("date") ), "date"],
            "start" => [Rule::requiredIf(request()->has("start") )],
            "end" => [Rule::requiredIf(request()->has("end") and auth('admin')->check())],
            "description" => [Rule::requiredIf(request()->has("description") ), "max:100"]
        ];
    }
}
