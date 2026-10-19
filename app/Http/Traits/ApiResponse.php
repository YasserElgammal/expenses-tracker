<?php

namespace App\Http\Traits;

use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;

trait ApiResponse
{
    public function successResponse(?string $message = null, mixed $data = null)
    {
        return $this->responseHandle(status: true, message: $message, data: $data, code: Response::HTTP_OK);
    }

    public function failResponse(?string $message, mixed $data = null, int $code = Response::HTTP_BAD_REQUEST)
    {
        return $this->responseHandle(status: false, message: $message, data: $data, code: $code);
    }

    public function validationResponse(mixed $errors, ?string $message = 'Validation errors', int $code = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        return $this->responseHandle(status: false, message: $message, data: null, code: $code, errors: $errors);
    }

    private function responseHandle(
        bool $status,
        int $code,
        ?string $message = null,
        mixed $data = null,
        mixed $errors = null
    ) {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => null,
        ];

        if ($errors !== null) {
            $response['errors'] = $this->formatErrors($errors);
        }

        if ($data !== null) {
            $response = array_merge(
                $response,
                $this->formatResponseData($data)
            );
        }

        return response()->json($response, $code);
    }

    private function formatErrors(mixed $errors): mixed
    {
        if ($errors instanceof Validator) {
            return $errors->errors();
        }

        if ($errors instanceof MessageBag) {
            return $errors->toArray();
        }

        return $errors;
    }

    private function formatResponseData(mixed $data): array
    {
        if ($data instanceof LengthAwarePaginator || $data instanceof Paginator) {
            return $this->formatPaginator($data);
        }

        if (is_object($data) && method_exists($data, 'response')) {
            return $this->formatResource($data);
        }

        return ['data' => $data];
    }

    private function formatPaginator(
        LengthAwarePaginator|Paginator $paginator
    ): array {
        $paginatedData = $paginator->toArray();

        $data = $paginatedData['data'] ?? [];

        unset($paginatedData['data']);

        return [
            'data' => $data,
            'meta' => $paginatedData,
        ];
    }

    private function formatResource(object $resource): array
    {
        $responseData = $resource->response()->getData(true);

        if (!isset($responseData['data'])) {
            return ['data' => $responseData];
        }

        $result = [
            'data' => $responseData['data'],
        ];

        foreach (['links', 'meta'] as $key) {
            if (isset($responseData[$key])) {
                $result[$key] = $responseData[$key];
            }
        }

        return $result;
    }
}
