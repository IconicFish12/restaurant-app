<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePerformanceRequest extends FormRequest
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
            "date" => ["required", "date"],
            "start" => ["required"],
            "description" => ["required", "max:100"]
        ];
    }
}
