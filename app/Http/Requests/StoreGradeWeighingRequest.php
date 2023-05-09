<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGradeWeighingRequest extends FormRequest
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
            'purchase_reciept_id' =>['required' , 'uuid'],
            'bulk_outturns' =>['required' , 'string'],
            'classification' =>['required' , 'string'],
            'pockets' =>['required' , 'numeric'],
            'bags' =>['required' , 'numeric'],
        ];
    }
}
