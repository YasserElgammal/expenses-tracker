<?php

namespace App\Http\Traits;

use Illuminate\Http\Response;

trait ApiResponse
{
    public function successReponse($message = null, mixed $data = null)
    {
        return $this->responseHandle(status: true, message: $message, data: $data, code: Response::HTTP_OK);
    }

    public function failResponse($message, $data = null, $code = Response::HTTP_BAD_REQUEST)
    {
        return $this->responseHandle(status: false, message: $message, data: $data, code: $code);
    }

    private function responseHandle(bool $status, string $message = null, mixed $data = null, int $code)
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data?->response()->getData(true),
        ];
        return response($response, $code);
    }
}
