<?php

namespace App\Http\Resources\V1\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SimpleListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
