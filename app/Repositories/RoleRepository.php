<?php

namespace App\Repositories;



use Spatie\Permission\Models\Role;

class RoleRepository
{
    public function findById($id)
    {
        return Role::find($id);
    }

    public function getAllRoles($perPage = 10,$search=null)
    {
        $roles = Role::query();
        if($search){
            $roles = $roles->where('name', 'LIKE', "%{$search}%");
        }
        return $roles->paginate($perPage);
    }

    public function createRole(array $data)
    {
        return Role::create($data);
    }

    public function deleteRole($id): int
    {
        return Role::destroy($id);
    }

    public function updateRole(array $data,$id)
    {
        $role = Role::find($id)->update($data);
        return $role->fresh();
    }
}
