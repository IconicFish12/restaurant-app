<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
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
            "name" => "required",
            "category_id" => "required",
            "menu_type" => "required",
            "price" => "required|integer",
            "description" => "required",
            "image" => "image|max:6000|mimes:png,jpg,jpeg"
        ];
    }

   
}
