<?php

namespace App\DataTransferObjects\V1\Category;

use App\Enums\V1\AddedSource;
use App\Http\Requests\V1\Api\CategoryRequest;

class CategoryDto
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly string $type,
        public readonly string $user_id,
        public readonly AddedSource $added_source
    ) {
    }

    public static function comingRequestFromApi(CategoryRequest $request)
    {
        return new self(
            name: $request->validated('name'),
            description: $request->validated('description'),
            type: $request->validated('type'),
            user_id: auth()->id(),
            added_source: AddedSource::API
        );
    }
}
