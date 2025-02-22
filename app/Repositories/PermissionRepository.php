<?php

namespace App\Repositories;


use Spatie\Permission\Models\Permission;


class PermissionRepository
{
    public function findById($id)
    {
        return Permission::find($id);
    }

    public function getAllPermissions($perPage = 10,$search=null)
    {
        $permissions = Permission::query();
        if($search){
            $permissions = $permissions->where('name', 'LIKE', "%{$search}%");
        }
        return $permissions->paginate($perPage);
    }

    public function createPermission(array $data)
    {
        return Permission::create($data);
    }

    public function deletePermission($id): int
    {
        return Permission::destroy($id);
    }

    public function updatePermission(array $data,$id)
    {
        $permission = Permission::find($id)->update($data);
        return $permission->fresh();
    }
}
