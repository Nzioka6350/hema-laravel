<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoffeeBeanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'coffee_grades' => ['array', 'nullable'],
            'coffee_grades.*' => ['uuid', 'nullable'],
        ];
    }
}
