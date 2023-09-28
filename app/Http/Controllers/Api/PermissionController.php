<?php

namespace App\Http\Controllers\Api;

use App\Services\PermissionService;
use Illuminate\Http\JsonResponse;
use Throwable;

/**
 * APIs for managing permissions
 *
 * @group Permission management
 * @class PermissionController
 */
class PermissionController extends BaseApiController
{
    /**
     * @param PermissionService $permissionService
     */
    public function __construct(
        private readonly PermissionService $permissionService,
    )
    {
    }

    /**
     * Get list permission return json response
     *
     * @authenticated
     *
     * @responseFile status=401 resources/responses/error/unauthorized.json
     * @responseFile status=403 resources/responses/error/forbidden.json
     * @responseFile status=500 resources/responses/error/internal_server_error.json
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function index(): JsonResponse
    {
        $responseData = $this->permissionService->getAllPermission();

        return $this->responseJson($responseData);
    }

    /**
     * Get group permission return json response
     *
     * @authenticated
     *
     * @responseFile status=401 resources/responses/error/unauthorized.json
     * @responseFile status=403 resources/responses/error/forbidden.json
     * @responseFile status=500 resources/responses/error/internal_server_error.json
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function getGroupPermission(): JsonResponse
    {
        $responseData = $this->permissionService->getGroupPermission();

        return $this->responseJson($responseData);
    }
}
