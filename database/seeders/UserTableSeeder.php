<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Config;

class UserTableSeeder extends Seeder
{
    public function __construct(
        private readonly UserRepository $userRepository
    )
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->userRepository->createOrUpdate(
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Config::get('constants.default_password'),
            ],
            ['email' => 'admin@gmail.com']
        );
    }


}
