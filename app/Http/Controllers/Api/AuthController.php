<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends BaseApiController
{
    public function __construct(
        private readonly AuthService $authService
    )
    {
    }

    /**
     * Login user
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->only('user_name', 'password','remember_me');

        $responseData = $this->authService->login($data);

        return $this->responseJson($responseData);
    }

    /**
     * Logout user
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $responseData = $this->authService->logout();

        return $this->responseJson($responseData);
    }

    /**
     * Get user info
     *
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        $responseData = $this->authService->getUser();

        return $this->responseJson($responseData);
    }
}
