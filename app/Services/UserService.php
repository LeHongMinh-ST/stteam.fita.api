<?php

namespace App\Services;

use App\DTO\ResponseData;
use App\Repositories\User\UserRepository;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * @class UserService
 */
class UserService extends BaseService
{
    /**
     *
     * @param UserRepository $userRepository
     */
    public function __construct(
        private readonly UserRepository $userRepository
    )
    {
    }

    /**
     * Handle get list user
     *
     * @param array $data
     * @return ResponseData
     *
     * @throws Throwable
     *
     * @author Le Hong Minh
     */
    public function getListUser(array $data = []): ResponseData
    {
        try {
            return $this->dataSuccess($this->userRepository->getListData($data));
        } catch (Throwable $exception) {
            Log::error(__METHOD__);
            Log::error($exception->getMessage());
            return $this->dataInternalServerError();
        }
    }

    /**
     * Handle get user by id
     *
     * @param int $id
     * @return ResponseData
     *
     * @throws Throwable
     *
     * @author Le Hong Minh
     */
    public function getUserById(int $id): ResponseData
    {
        try {
            $user = $this->userRepository->findById($id);
            if (!$user) {
                return $this->dataNotFound();
            }
            return $this->dataSuccess($user);
        } catch (Throwable $exception) {
            Log::error(__METHOD__);
            Log::error($exception->getMessage());
            return $this->dataInternalServerError();
        }
    }

    /**
     * Handle create user
     *
     * @param array $data
     * @return ResponseData
     *
     * @throws Throwable
     *
     * @author Le Hong Minh
     */
    public function createUser(array $data): ResponseData
    {
        try {
            if (empty($data['password'])) {
                $data['password'] = Config::get('constants.default_password');
            }
            $user = $this->userRepository->createOrUpdate($data);
            return $this->dataCreateSuccess($user);
        } catch (Throwable $exception) {
            Log::error(__METHOD__);
            Log::error($exception->getMessage());
            return $this->dataInternalServerError();
        }
    }

    /**
     * Handle update user
     *
     * @param int $id
     * @param array $data
     * @return ResponseData
     *
     * @throws Throwable
     *
     * @author Le Hong Minh
     */
    public function updateUser(int $id, array $data): ResponseData
    {
        try {
            $user = $this->userRepository->findById($id);
            if (!$user) {
                return $this->dataNotFound();
            }
            $user = $this->userRepository->createOrUpdate($data, ['id' => $id]);
            return $this->dataSuccess($user);
        } catch (Throwable $exception) {
            Log::error(__METHOD__);
            Log::error($exception->getMessage());
            return $this->dataInternalServerError();
        }
    }

    /**
     * Handle delete user
     *
     * @param int $id
     * @return ResponseData
     *
     * @throws Throwable
     *
     * @author Le Hong Minh
     */
    public function deleteUser(int $id): ResponseData
    {
        try {
            $user = $this->userRepository->findById($id);
            if (!$user) {
                return $this->dataNotFound();
            }
            $this->userRepository->delete($user);
            return $this->dataNoContent();
        } catch (Throwable $exception) {
            Log::error(__METHOD__);
            Log::error($exception->getMessage());
            return $this->dataInternalServerError();
        }
    }

}
