<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyProfileRequest extends FormRequest
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
            //
            'name' => ['string'],
            'address_id' => ['uuid'],
            'barcode_no' => ['string'],
            'license_no' => ['numeric'],
            'pin_no' => ['string'],
            'vat_no' => ['string'],
        ];
    }
}
