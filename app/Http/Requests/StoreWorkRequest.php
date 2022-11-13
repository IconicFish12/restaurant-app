<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreWorkRequest extends FormRequest
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
            "employee_id" => ["required"],
            "job_desk" => ["required", "max:100", "min:10"],
            "job_done" => [Rule::requiredIf(Auth::guard('employee')->check() and request()->has('job_done')), "date_format:h:i:s"]
        ];
    }
}
