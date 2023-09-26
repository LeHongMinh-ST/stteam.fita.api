<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\StoreUserRequest;
use App\Http\Requests\Api\User\UpdateUserRequest;
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

    /**
     * Get user by id
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $responseData = $this->userService->getUserById($id);

        return $this->responseJson($responseData);
    }

    /**
     * Create user
     *
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $data = $request->all();

        $responseData = $this->userService->createUser($data);

        return $this->responseJson($responseData);
    }

    /**
     * Update user
     *
     * @param int $id
     * @param UpdateUserRequest $request
     * @return JsonResponse
     */
    public function update(int $id, UpdateUserRequest $request): JsonResponse
    {
        $data = $request->all();

        $responseData = $this->userService->updateUser($id, $data);

        return $this->responseJson($responseData);
    }

    /**
     * Delete user
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $responseData = $this->userService->deleteUser($id);

        return $this->responseJson($responseData);
    }
}
