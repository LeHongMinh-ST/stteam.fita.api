<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Throwable;

/**
 * APIs for managing auth
 *
 * @group Auth management
 * @class AuthController
 */
class AuthController extends BaseApiController
{
    public function __construct(
        private readonly AuthService $authService
    )
    {
    }

    /**
     * Login user
     **
     * @responseFile status=200 resources/responses/auth/login.json
     * @responseFile status=401 resources/responses/error/unauthorized.json
     * @responseFile status=500 resources/responses/error/internal_server_error.json
     *
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws Throwable
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
     * @authenticated
     *
     * @responseFile status=401 resources/responses/error/unauthorized.json
     * @responseFile status=500 resources/responses/error/internal_server_error.json
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function logout(): JsonResponse
    {
        $responseData = $this->authService->logout();

        return $this->responseJson($responseData);
    }

    /**
     * Get user info
     *
     * @authenticated
     *
     * @responseFile status=401 resources/responses/error/unauthorized.json
     * @responseFile status=500 resources/responses/error/internal_server_error.json
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function me(): JsonResponse
    {
        $responseData = $this->authService->getUser();

        return $this->responseJson($responseData);
    }
}
