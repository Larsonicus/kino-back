<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'accessToken' => $this->resource->accessToken,
            'tokenType' => $this->resource->tokenType,
            'expiresIn' => $this->resource->expiresIn,
            'user' => new UserResource($this->resource->user),
        ];
    }
}
