<?php

namespace App\Services;

use App\DTO\ResponseData;
use App\Repositories\User\UserRepository;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Log;

class UserService extends BaseService
{
    public function __construct(
        private readonly UserRepository $userRepository
    )
    {
    }

    public function getListUser(array $data = []): ResponseData
    {
        try {
            return $this->dataSuccess($this->userRepository->getListData($data));
        } catch (Exception $exception) {
            Log::error(__METHOD__);
            Log::error($exception->getMessage());
            return $this->dataInternalServerError();
        }
    }


}
