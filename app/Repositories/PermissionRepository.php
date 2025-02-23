<?php

namespace App\Repositories;


use App\Events\EventCreatePermission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;


class PermissionRepository
{
    public function findById($id)
    {
        return Permission::find($id);
    }

    public function getAllPermissions($search=null): LengthAwarePaginator
    {
        $permissions = Permission::query();
        if(isset($search['search'])){
            $permissions = $permissions->where('name', 'LIKE', "%{$search['search']}%");
        }
        return $permissions->paginate(10);
    }

    public function createPermission(array $data)
    {
        DB::beginTransaction();
        try {
            $permission = Permission::create($data);
            new EventCreatePermission($permission);
            DB::commit();
            return $permission;
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error($exception->getMessage());
        }

    }

    public function deletePermission($id): int
    {
        return Permission::destroy($id);
    }

    public function updatePermission(array $data,$id)
    {
        return Permission::find($id)->update($data);
    }
}
