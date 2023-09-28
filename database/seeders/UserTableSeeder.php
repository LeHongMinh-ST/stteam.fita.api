<?php

namespace Database\Seeders;

use App\Repositories\User\UserRepository;
use Illuminate\Database\Seeder;
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
                'full_name' => 'Admin',
                'user_name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Config::get('constants.default_password'),
                'is_super_admin' => true,
            ],
            ['email' => 'admin@gmail.com']
        );

//        User::castAndCreate([
//            'full_name' => 'Admin',
//            'user_name' => 'admin',
//            'email' => 'admin@gmail.com',
//            'password' => Config::get('constants.default_password'),
//        ]);
    }


}
