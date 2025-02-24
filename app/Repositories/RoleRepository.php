<?php

namespace App\Repositories;


use App\Repositories\Interfaces\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    public function find($id)
    {
        return Role::find($id);
    }

    public function all( $search = null)
    {
        $roles = Role::query();
        if(isset($search['search'])){
            $roles = $roles->where('name', 'LIKE', "%{$search['search']}%");
        }
        return $roles->paginate( 10);
    }

    public function create(array $array)
    {
        return Role::create($array);
    }

    public function delete($id): int
    {
        return Role::destroy($id);
    }

    public function update(array $data, $id)
    {
        return Role::find($id)->update($data);
    }
}
