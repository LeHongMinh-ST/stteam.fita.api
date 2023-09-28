<?php

namespace App\Services;

use App\DTO\ResponseData;
use App\Models\Role;
use App\Repositories\Role\RoleRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * @class RoleService
 */
class RoleService extends BaseService
{
    /**
     * @param RoleRepository $roleRepository
     */
    public function __construct(
        private readonly RoleRepository $roleRepository
    )
    {
    }

    /**
     * Handle get list role
     *
     * @param array $data
     * @return ResponseData
     *
     * @throws Throwable
     *
     * @author Le Hong Minh
     */
    public function getListRole(array $data = []): ResponseData
    {
        try {
            return $this->dataSuccess($this->roleRepository->getListData($data));
        } catch (Throwable $exception) {
            Log::error(__METHOD__);
            Log::error($exception->getMessage());
            return $this->dataInternalServerError();
        }
    }

    /**
     * Handle get role by id
     *
     * @param int $id
     * @return ResponseData
     *
     * @throws Throwable
     *
     * @author Le Hong Minh
     */
    public function getRoleById(int $id): ResponseData
    {
        try {
            $role = $this->roleRepository->findById($id);
            if (!$role) {
                return $this->dataNotFound();
            }

            return $this->dataSuccess($role);
        } catch (Throwable $exception) {
            Log::error(__METHOD__);
            Log::error($exception->getMessage());
            return $this->dataInternalServerError();
        }
    }

    /**
     * Handle create role
     *
     * @param array $data
     * @return ResponseData
     *
     * @throws Throwable
     *
     * @author Le Hong Minh
     */
    public function createRole(array $data = []): ResponseData
    {
        DB::beginTransaction();
        try {
            $role = $this->roleRepository->createOrUpdate($data);

            $role->permissions()->attach(@$data['permission_ids'] ?? []);

            DB::commit();
            return $this->dataCreateSuccess($role);
        } catch (Throwable $exception) {
            DB::rollBack();

            Log::error(__METHOD__);
            Log::error($exception->getMessage());
            return $this->dataInternalServerError();
        }
    }

    /**
     * Handle update role
     *
     * @param int $id
     * @param array $data
     * @return ResponseData
     *
     * @throws Throwable
     *
     * @author Le Hong Minh
     */
    public function updateRole(int $id, array $data = []): ResponseData
    {
        DB::beginTransaction();
        try {
            $role = $this->roleRepository->findById($id);

            if (!$role) {
                return $this->dataNotFound();
            }

            $permissionIds = $data['permission_ids'] ?? [];

            $data = getOnlyFields($data, Role::ONLY_UPDATE_REQUEST_FIELDS);

            $role = $this->roleRepository->createOrUpdate($data, ['id' => $id]);

            $role->permissions()->sync($permissionIds);

            DB::commit();
            return $this->dataSuccess($role);
        } catch (Throwable $exception) {
            DB::rollBack();
            Log::error(__METHOD__);
            Log::error($exception->getMessage());

            return $this->dataInternalServerError();
        }
    }

    /**
     * Handle delete role
     *
     * @param int $id
     * @return ResponseData
     *
     * @throws Throwable
     *
     * @author Le Hong Minh
     */
    public function deleteRole(int $id): ResponseData
    {
        try {
            $role = $this->roleRepository->findById($id);

            if (!$role) {
                return $this->dataNotFound();
            }

            $this->roleRepository->delete($role);
            return $this->dataNotFound();
        } catch (Throwable $exception) {
            Log::error(__METHOD__);
            Log::error($exception->getMessage());
            return $this->dataInternalServerError();
        }
    }


}
