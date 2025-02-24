<?php

namespace App\Repositories;


use App\Events\EventCreatePermission;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;


class PermissionRepository implements PermissionRepositoryInterface
{
    public function find($id)
    {
        return Permission::find($id);
    }

    public function all($search=null): LengthAwarePaginator
    {
        $permissions = Permission::query();
        if(isset($search['search'])){
            $permissions = $permissions->where('name', 'LIKE', "%{$search['search']}%");
        }
        return $permissions->paginate(10);
    }

    public function create(array  $array)
    {
        DB::beginTransaction();
        try {
            $permission = Permission::create($array);
            new EventCreatePermission($permission);
            DB::commit();
            return $permission;
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error($exception->getMessage());
        }
    }

    public function delete($id): int
    {
        return Permission::destroy($id);
    }

    public function update(array $data,$id)
    {
        return Permission::find($id)->update($data);
    }
}
