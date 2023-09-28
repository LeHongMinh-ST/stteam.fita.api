<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\User\StoreUserRequest;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;

/**
 * APIs for managing users
 *
 * @group User management
 * @class UserController
 */
class UserController extends BaseApiController
{
    /**
     * @param UserService $userService
     */
    public function __construct(
        private readonly UserService $userService
    )
    {
    }

    /**
     * Get list user
     *
     * @authenticated
     *
     * @queryParam page int Page number of paginated data. Example: 1
     * @queryParam limit int Number of items per page. Example: 10
     * @queryParam sort string Sort data by created_at field. Example: desc
     * @queryParam q string Search data by name field and email field. Example: test
     *
     * @responseFile status=200 resources/responses/user/user.get.json
     * @responseFile status=401 resources/responses/error/unauthorized.json
     * @responseFile status=403 resources/responses/error/forbidden.json
     * @responseFile status=500 resources/responses/error/internal_server_error.json
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
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
     * @authenticated
     *
     * @urlParam id int required The ID of the user. Example: 1
     *
     * @responseFile status=200 resources/responses/user/user.show.json
     * @responseFile status=401 resources/responses/error/unauthorized.json
     * @responseFile status=403 resources/responses/error/forbidden.json
     * @responseFile status=500 resources/responses/error/internal_server_error.json
     *
     * @param int $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function show(int $id): JsonResponse
    {
        $responseData = $this->userService->getUserById($id);

        return $this->responseJson($responseData);
    }

    /**
     * Create user
     *
     * @authenticated
     *
     * @responseFile status=200 resources/responses/user/user.show.json
     * @responseFile status=401 resources/responses/error/unauthorized.json
     * @responseFile status=403 resources/responses/error/forbidden.json
     * @responseFile status=422 resources/responses/error/unprocessable_entity.json
     * @responseFile status=500 resources/responses/error/internal_server_error.json
     *
     * @param StoreUserRequest $request
     * @return JsonResponse
     * @throws Throwable
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
     * @authenticated
     *
     * @responseFile status=200 resources/responses/user/user.show.json
     * @responseFile status=401 resources/responses/error/unauthorized.json
     * @responseFile status=403 resources/responses/error/forbidden.json
     * @responseFile status=422 resources/responses/error/unprocessable_entity.json
     * @responseFile status=500 resources/responses/error/internal_server_error.json
     *
     * @param int $id
     * @param UpdateUserRequest $request
     * @return JsonResponse
     * @throws Throwable
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
     * @authenticated
     *
     * @response 204 {}
     * @responseFile status=401 resources/responses/error/unauthorized.json
     * @responseFile status=403 resources/responses/error/forbidden.json
     * @responseFile status=500 resources/responses/error/internal_server_error.json
     *
     * @param int $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(int $id): JsonResponse
    {
        $responseData = $this->userService->deleteUser($id);

        return $this->responseJson($responseData);
    }
}
