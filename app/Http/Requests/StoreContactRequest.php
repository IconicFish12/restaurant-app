<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'name' => ["required", "max:100", "string"],
            'email' => ["required", "email:dns", "unique:contacts"],
            'subject' => ["required", "max:50",],
            'message' => ["required", "string"]
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
            'email.unique' => 'email must unique',
            'subject.required' => "A Subject is required",
            'message.required' => 'A message is required',
            'name.max' => 'Name cannot be more than 100',
            'subject.max' => 'Subject cannot be more than 100',
            "email.required" => "A Email is required",
            "email.email" => "The Email Must Valid",
        ];
    }
}
