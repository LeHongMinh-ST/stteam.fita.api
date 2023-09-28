<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Role\StoreRoleRequest;
use App\Http\Requests\Api\Role\UpdateRoleRequest;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 *
 */
class RoleController extends BaseApiController
{
    /**
     * @param RoleService $roleService
     */
    public function __construct(
        private readonly RoleService $roleService
    )
    {
    }

    /**
     * Get list role return json response
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function index(Request $request): JsonResponse
    {
        $data = $request->all();

        $responseData = $this->roleService->getListRole($data);

        return $this->responseJson($responseData);
    }

    /**
     * Get role by id
     *
     * @param int $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function show(int $id): JsonResponse
    {
        $responseData = $this->roleService->getRoleById($id);

        return $this->responseJson($responseData);
    }

    /**
     * Create role
     *
     * @param StoreRoleRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(StoreRoleRequest $request): JsonResponse
    {
        $data = $request->all();

        $responseData = $this->roleService->createRole($data);

        return $this->responseJson($responseData);
    }

    /**
     * Update role
     *
     * @param int $id
     * @param UpdateRoleRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(int $id, UpdateRoleRequest $request): JsonResponse
    {
        $data = $request->all();

        $responseData = $this->roleService->updateRole($id, $data);

        return $this->responseJson($responseData);
    }

    /**
     * Delete role
     *
     * @param int $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(int $id): JsonResponse
    {
        $responseData = $this->roleService->deleteRole($id);

        return $this->responseJson($responseData);
    }

}
