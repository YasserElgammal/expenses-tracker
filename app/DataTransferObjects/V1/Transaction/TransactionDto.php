<?php

namespace App\DataTransferObjects\V1\Transaction;

use App\Enums\V1\AddedSource;
use App\Http\Requests\V1\Api\TransactionRequest;

class TransactionDto
{
    public function __construct(
        public readonly float $amount,
        public readonly string $description,
        public readonly string $date,
        public readonly string $category_id,
        public readonly string $user_id,
        public readonly AddedSource $added_source
    ) {
    }

    public static function comingRequestFromApi(TransactionRequest $request) {
        return new self(
            amount: $request->validated('amount'),
            description: $request->validated('description'),
            date: $request->validated('date'),
            category_id:  $request->validated('category_id'),
            user_id:  auth()->id(),
            added_source: AddedSource::API
        );

    }
}
