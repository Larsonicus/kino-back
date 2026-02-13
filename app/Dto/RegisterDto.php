<?php

namespace App\Dto;

use Illuminate\Http\Request;

class RegisterDto
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {}

    public static function fromRequest(Request $request): self
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        return new self(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
        );
    }
}
