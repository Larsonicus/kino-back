<?php

namespace App\Services;

use App\Dto\LoginDto;
use App\Dto\RegisterDto;
use App\Dto\AuthResponseDto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(LoginDto $dto): ?AuthResponseDto
    {
        $user = User::where('name', $dto->name)->first();

        if (!$user || !Hash::check($dto->password, $user->password)) {
            return null;
        }

        return $this->generateToken($user);
    }

    public function register(RegisterDto $dto): AuthResponseDto
    {
        $user = User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
        ]);

        return $this->generateToken($user);
    }

    public function logout(User $user): void
    {
        auth()->logout();
    }

    protected function generateToken(User $user): AuthResponseDto
    {
        $accessToken = auth()->login($user);

        return new AuthResponseDto(
            accessToken: $accessToken,
            tokenType: 'bearer',
            expiresIn: auth()->factory()->getTTL() * 60,
            user: $user
        );
    }
}
