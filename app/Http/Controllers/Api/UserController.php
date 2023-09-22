<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends BaseApiController
{
    public function __construct(
        private readonly UserService $userService
    )
    {
    }

    public function index(): JsonResponse
    {
        $responseData = $this->userService->getListUser();

        return $this->responseJson($responseData);
    }
}
