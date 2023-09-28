<?php

namespace App\Services;

use App\DTO\ResponseData;
use App\Repositories\GroupPermission\GroupPermissionRepository;
use App\Repositories\Permission\PermissionRepository;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 *
 */
class PermissionService extends BaseService
{
    /**
     * @param PermissionRepository $permissionRepository
     * @param GroupPermissionRepository $groupPermissionRepository
     */
    public function __construct(
        private readonly PermissionRepository      $permissionRepository,
        private readonly GroupPermissionRepository $groupPermissionRepository
    )
    {
    }

    /**
     * Handle get all permission
     *
     * @return ResponseData
     */
    public function getAllPermission(): ResponseData
    {
        try {
            return $this->dataSuccess($this->permissionRepository->all());

        } catch (Throwable $exception) {
            Log::error(__METHOD__);
            Log::error($exception->getMessage());
            return $this->dataInternalServerError();
        }
    }

    /**
     * Handle get group permission
     *
     * @return ResponseData
     */
    public function getGroupPermission(): ResponseData
    {
        try {
            return $this->dataSuccess($this->groupPermissionRepository->all(['*'], ['permissions']));

        } catch (Throwable $exception) {
            Log::error(__METHOD__);
            Log::error($exception->getMessage());
            return $this->dataInternalServerError();
        }
    }
}
