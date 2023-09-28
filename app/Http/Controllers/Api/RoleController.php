<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Role\StoreRoleRequest;
use App\Http\Requests\Api\Role\UpdateRoleRequest;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * APIs for managing roles
 *
 * @group Role management
 * @class RoleController
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
     * @authenticated
     *
     * @queryParam page int Page number of paginated data. Example: 1
     * @queryParam limit int Number of items per page. Example: 10
     * @queryParam sort string Sort data by created_at field. Example: desc
     * @queryParam q string Search data by name field. Example: test
     *
     * @responseFile status=200 resources/responses/role/role.get.json
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

        $responseData = $this->roleService->getListRole($data);

        return $this->responseJson($responseData);
    }

    /**
     * Get role by id
     *
     * @authenticated
     *
     * @responseFile status=200 resources/responses/role/role.show.json
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
        $responseData = $this->roleService->getRoleById($id);

        return $this->responseJson($responseData);
    }

    /**
     * Create role
     *
     * @authenticated
     *
     * @responseFile status=200 resources/responses/role/role.show.json
     * @responseFile status=401 resources/responses/error/unauthorized.json
     * @responseFile status=403 resources/responses/error/forbidden.json
     * @responseFile status=422 resources/responses/error/unprocessable_entity.json
     * @responseFile status=500 resources/responses/error/internal_server_error.json
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
     * @authenticated
     *
     * @responseFile status=200 resources/responses/role/role.show.json
     * @responseFile status=401 resources/responses/error/unauthorized.json
     * @responseFile status=403 resources/responses/error/forbidden.json
     * @responseFile status=422 resources/responses/error/unprocessable_entity.json
     * @responseFile status=500 resources/responses/error/internal_server_error.json
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
        $responseData = $this->roleService->deleteRole($id);

        return $this->responseJson($responseData);
    }

}
