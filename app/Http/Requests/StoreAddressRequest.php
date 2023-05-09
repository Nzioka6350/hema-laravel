<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
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
            'address' => ['required', 'string'],
            'web_url' => ['required', 'string'],
            'street' => ['required', 'string'],
            'fax_no' => ['required', 'string'],
            'telephone' => ['required', 'string'],
            'email' => ['required', 'string'],
            'postalcode' => ['required', 'string'],
            'city' => ['required', 'string'],
        ];
    }
}
