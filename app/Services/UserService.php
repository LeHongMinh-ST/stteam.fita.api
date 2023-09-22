<?php

namespace App\Services;

use App\DTO\ResponseData;
use App\Repositories\User\UserRepository;
use App\Services\BaseService;

class UserService extends BaseService
{
    public function __construct(
        private readonly UserRepository $userRepository
    )
    {
    }

    public function getListUser(): ResponseData
    {
        return $this->dataSuccess($this->userRepository->all());
    }


}
