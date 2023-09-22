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

    /**
     * Get list user return json response
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $data = $request->all();

        $responseData = $this->userService->getListUser($data);

        return $this->responseJson($responseData);
    }
}
