<?php

namespace App\Dto;

use Illuminate\Http\Request;

class LoginDto
{
    public function __construct(
        public readonly string $name,
        public readonly string $password,
    ) {}

    public static function fromRequest(Request $request): self
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        return new self(
            name: $validated['name'],
            password: $validated['password'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'password' => $this->password,
        ];
    }
}
