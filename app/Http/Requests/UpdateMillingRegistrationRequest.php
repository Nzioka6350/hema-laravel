<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMillingRegistrationRequest extends FormRequest
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
            'name_of_miller' => ['string'],
            'month' => ['date'],
            'milling_date' => ['date'],
            'company_profile_id' => ['uuid'],
            'purchase_reciept_id' => ['uuid'],
            'grower_id' => ['uuid'],
            'physical_address' => ['string'],
        ];
    }
}
