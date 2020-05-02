<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            'document_number' => 'required|max:191',
            'phone_number' => 'required|max:191',
            'mobile_phone_number' => 'required|max:191',
            'email' => 'required|email|max:191',
            'postal_code' => 'required|max:191',
            'street_number' => 'required|max:191',
            'street_name' => 'required|max:191',
            'neighborhood' => 'required|max:191',
            'city' => 'required|max:191',
            'state' => 'required|max:191',
            'complement' => 'sometimes|string|nullable',
            'contact' => 'sometimes|string|nullable',
        ];
    }
}
