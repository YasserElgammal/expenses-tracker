<?php

namespace App\Http\Requests\V1\Api;

use App\Enums\V1\CategoryType;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $category_type = join(',', CategoryType::values());

        return [
            'name' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:255'],
            'type' =>  "required|in:{$category_type}",
        ];
    }
}
