<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            "menu_id" => ["required"],
            "table_id" => ["required"],
            "user_id" => ["required"],
            "payment_method" => ["required", "max:20"],
            "quantity" => ["required", "integer", "max:200"],
            "price" => ["required", "numeric"],
            "detail" => ["max:200"]
        ];
    }
}
