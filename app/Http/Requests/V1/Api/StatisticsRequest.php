<?php

namespace App\Http\Requests\V1\Api;

use Illuminate\Foundation\Http\FormRequest;

class StatisticsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'month' => ['nullable', 'integer', 'between:1,12'],
            'year' => ['required_with:month', 'nullable', 'integer', 'digits:4'],
            'items_per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }
}
