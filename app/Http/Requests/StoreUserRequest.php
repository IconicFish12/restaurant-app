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
            'username' => ["required", "max:50", "min:6","unique:users"],
            'password' => ["required", "min:6", "unique:users"],
            'email' => ["required", "email:dns", "unique:users"]
        ];
    }
}
