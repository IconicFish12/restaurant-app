<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
            "name" => "required|unique:menus",
            "category_id" => "required",
            "price" => "required|integer",
            "description" => "required",
            "brief_description" => "required|max:50",
            "image" => "required|image|max:6000|mimes:png,jpg,jpeg"
        ];
    }


}
