<?php

namespace App\Http\Controllers;

use App\Dto\LoginDto;
use App\Dto\RegisterDto;
use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService
    ) {}

    public function login(Request $request): AuthResource
    {
        $dto = LoginDto::fromRequest($request);
        $response = $this->authService->login($dto);

        if (!$response) {
            throw new AuthenticationException('Invalid credentials');
        }

        return new AuthResource($response);
    }

    public function register(Request $request): AuthResource
    {

        $dto = RegisterDto::fromRequest($request);
        $response = $this->authService->register($dto);

        return new AuthResource($response);
    }

    public function logout(): JsonResponse
    {
        $this->authService->logout(auth()->user());

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me(): UserResource
    {
        return new UserResource(auth()->user());
    }
}
