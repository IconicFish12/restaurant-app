<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVoucherRequest extends FormRequest
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
            "name" => ["required"],
            "code" => [ Rule::requiredIf(request()->has('code')) , "max:10", "unique:vouchers"],
            "type" => ["required", "max:50"],
            "expired" => ["required", "date"],
            "amount" => ["required", "integer", "max:200"],
            "limit" => ["required", "integer", "max:200"],
            "minPurchase" => ["required", "numeric"],
            "description" => ["required", "string"],
        ];
    }
}
