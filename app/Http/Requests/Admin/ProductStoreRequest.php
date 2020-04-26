<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:191',
            'description' => 'required|max:191',
            'barcode' => 'max:191',
            'purchase_price' => 'required|numeric|gte:0',
            'sale_price' => 'required|numeric|gte:0',
            'unit' => 'required|max:191',
            'quantity_in_stock' => 'required|integer',
            'minimum_quantity_in_stock' => 'required|integer',
        ];
    }
}
