<?php

namespace App\Http\Requests\V1\Api;

use App\Enums\V1\CategoryType;
use App\Models\V1\Category;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $categoryType = Category::where('user_id', auth()->id())
            ->findOrFail(@$this->category_id)->type;

        return [
            'amount' => [
                'required', 'numeric',
                $categoryType ==  CategoryType::INCOME->value ? 'gt:0' : 'lt:0'
            ],
            'description' =>  ['required', 'min:3', 'max:255'],
            'date' =>  ['required', 'date', 'date_format:Y-m-d'],
            'category_id' =>  ['required', 'exists:categories,id'],
        ];
    }

    public function messages()
    {
        return [
            'amount.lt' => trans('app.transcations.amount.less_than'),
            'amount.gt' => trans('app.transcations.amount.greater_than'),
        ];
    }
}
