<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGradeWeighingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'purchase_reciept_id' => ['uuid'],
            'bulk_outturns' => ['string'],
            'classification' => ['string'],
            'pockets' => ['numeric'],
            'bags' => ['numeric'],
        ];
    }
}
