<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['string', 'required'],
            'address_id'=>['uuid', 'required'],
            'barcode_no'=>['string', 'required'],
            'license_no'=>['numeric', 'required'],
            'pin_no'=>['string', 'required'],
            'vat_no'=>['string', 'required'],
        ];
    }
}
