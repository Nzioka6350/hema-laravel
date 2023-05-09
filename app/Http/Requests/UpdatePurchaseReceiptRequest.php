<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePurchaseReceiptRequest extends FormRequest
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
            'bags_in_outturn' => ['numeric'],
            'bags_in' => ['string'],
            'bags_in_delivery' => ['numeric'],
            'delivery_vehicle_no' => ['string'],
            'store' => ['string'],
            'row' => ['string'],
            'bay' => ['string'],
            'floor' => ['string'],
            'coffee_bean_id' => ['uuid'],
            'grower_id' => ['uuid'],
        ];
    }
}
