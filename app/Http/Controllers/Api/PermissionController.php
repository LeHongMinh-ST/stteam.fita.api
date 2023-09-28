<?php

namespace App\Http\Controllers\Api;

use App\Services\PermissionService;
use Illuminate\Http\JsonResponse;
use Throwable;

/**
 *
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
     * @return JsonResponse
     * @throws Throwable
     */
    public function getGroupPermission(): JsonResponse
    {
        $responseData = $this->permissionService->getGroupPermission();

        return $this->responseJson($responseData);
    }
}
