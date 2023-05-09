<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMillingRegistrationRequest extends FormRequest
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
            'name_of_miller' => ['required', 'string'],
            'month' => ['required', 'date'],
            'milling_date' => ['required', 'date'],
            'company_profile_id' => ['required', 'uuid'],
            'purchase_reciept_id' => ['required', 'uuid'],
            'grower_id' => ['required', 'uuid'],
            'physical_address' => ['required', 'string'],
        ];
    }
}
