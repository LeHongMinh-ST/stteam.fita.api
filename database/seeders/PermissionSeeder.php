<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = config('permission', []);
        foreach ($permissions as $permission) {
            $this->checkIssetBeforeCreate($permission);
        }
    }

    public function checkIssetBeforeCreate($data): void
    {
        $permission = Permission::where('code', $data['code'])->first();
        if (empty($permission)) {
            Permission::create($data);
        } else {
            $permission->update($data);
        }
    }
}
