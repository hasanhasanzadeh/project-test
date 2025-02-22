<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $keys = [
            'permission',
            'role',
            'customer',
            'category',
            'cost',
        ];

        $values = [
            'all',
            'find',
            'create',
            'update',
            'delete'
        ];

        $role = Role::whereName('superAdmin')->firstOrFail();

        foreach ($keys as $item) {
            foreach ($values as $value) {
                $permission = new Permission();
                $permission->name = $item . '-' . $value;
                $permission->display_name = $item . ' ' . $value;
                $permission->save();
                $role->givePermissionTo($permission);
            }
        }
        $user = User::whereEmail('admin@test.com')->firstOrFail();
        $user->assignRole($role);
    }
}
