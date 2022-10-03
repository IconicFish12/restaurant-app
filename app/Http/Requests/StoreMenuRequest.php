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
            "menu_type" => "required",
            "price" => "required|integer",
            "description" => "required",
            "image" => "required|image|max:6000|mimes:png,jpg,jpeg"
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
            'name.required' => 'Menu Name is required',
            'name.unique' => 'Menu Name Must Unique',
            'category_id.required' => "Category Menu is required",
            'menu_type.required' => "Menu Type is required",
            'price.required' => "Menu Price Is Required",
            'description.required' => "menu description is Required",
            'image.required' => "Menu Image Is required",
            'image.image' => "This field must be filled with pictures",
            'image.max' => "Image can't be too big",
            'image.mimes' => "allowed formats are jpg png and jpeg"
        ];
    }
}
