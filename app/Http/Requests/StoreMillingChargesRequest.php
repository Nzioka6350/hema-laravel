<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMillingChargesRequest extends FormRequest
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
            'machine_repair'=>['numeric', 'required'],
            'drying'=>['numeric', 'required'],
            'seedling'=>['numeric', 'required'],
            'advance'=>['numeric', 'required'],
            'parchment_transport'=>['numeric', 'required'],
            'clean_coffee_transport'=>['numeric', 'required'],
            'export_bags'=>['numeric', 'required'],
            'handling'=>['numeric', 'required'],
            'milling'=>['numeric', 'required'],
        ];
    }
}
