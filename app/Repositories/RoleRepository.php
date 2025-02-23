<?php

namespace App\Repositories;


use Spatie\Permission\Models\Role;

class RoleRepository
{
    public function findById($id)
    {
        return Role::find($id);
    }

    public function getAllRoles( $search = null)
    {
        $roles = Role::query();
        if(isset($search['search'])){
            $roles = $roles->where('name', 'LIKE', "%{$search['search']}%");
        }
        return $roles->paginate( 10);
    }

    public function createRole(array $data)
    {
        return Role::create($data);
    }

    public function deleteRole($id): int
    {
        return Role::destroy($id);
    }

    public function updateRole(array $data, $id)
    {
        return Role::find($id)->update($data);
    }
}
