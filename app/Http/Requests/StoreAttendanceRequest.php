<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAttendanceRequest extends FormRequest
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
            'email' => ["required","email:dns"],
            'status' => ["required"],
            'presence' => ["required"],
            'password' => ["required", "min:6"],
            'in' => ["date_format:H:i:s"],
            'out' => ["date_format:H:i:s"],
            "date" => ["required", "date"]
        ];
    }
}
