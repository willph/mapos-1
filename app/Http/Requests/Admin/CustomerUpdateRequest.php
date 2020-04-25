<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'name' => 'required',
            'document_number' => 'required',
            'phone_number' => 'required',
            'mobile_phone_number' => 'required',
            'email' => 'required',
            'postal_code' => 'required',
            'street_number' => 'required',
            'street_name' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',
        ];
    }
}
