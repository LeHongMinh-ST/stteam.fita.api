<?php

namespace Database\Seeders;

use App\Models\GroupPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = config('group-permission', []);
        foreach ($groups as $group) {
            $this->checkIssetBeforeCreate($group);
        }
    }

    private function checkIssetBeforeCreate($data): void
    {
        $groupPermission = GroupPermission::where('code', $data['code'])->first();
        if (empty($groupPermission)) {
            GroupPermission::create($data);
        } else {
            $groupPermission->update($data);
        }
    }
}
