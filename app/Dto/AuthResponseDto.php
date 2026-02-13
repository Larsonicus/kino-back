<?php

namespace App\Dto;

use App\Http\Resources\UserResource;
use App\Models\User;

class AuthResponseDto
{
    public function __construct(
        public readonly string $accessToken,
        public readonly string $tokenType,
        public readonly int $expiresIn,
        public readonly User $user,
    ) {}

    public function toArray(): array
    {
        return [
            'accessToken' => $this->accessToken,
            'tokenType' => $this->tokenType,
            'expiresIn' => $this->expiresIn,
            'user' => new UserResource($this->user),
        ];
    }
}
