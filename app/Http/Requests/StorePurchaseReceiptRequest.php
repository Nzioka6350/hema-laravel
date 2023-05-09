<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseReceiptRequest extends FormRequest
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
            'bags_in_outturn' => ['required', 'numeric'],
            'bags_in' => ['required', 'string'],
            'bags_in_delivery' => ['required', 'numeric'],
            'delivery_vehicle_no' => ['required', 'string'],
            'store' => ['required', 'string'],
            'row' => ['required', 'string'],
            'bay' => ['required', 'string'],
            'floor' => ['required', 'string'],
            'coffee_bean' => ['array', 'uuid'],
            'coffee_bean_.*' => ['required', 'uuid'],
            'grower_id' => ['required', 'uuid'],
        ];
    }
}
