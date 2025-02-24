<?php

namespace App\Services;

use App\Repositories\PermissionRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\Permission\Contracts\Permission;

readonly class PermissionService
{
    public function __construct(private PermissionRepository $permissionRepository)
    {
    }

    public function getPermissionById($id)
    {
        return $this->permissionRepository->find($id);
    }

    public function getAllPermissions($perPage,array $search=null): LengthAwarePaginator
    {
        return $this->permissionRepository->all($perPage,$search);
    }

    public function createPermission(array $data): Permission|\Spatie\Permission\Models\Permission|null
    {
        return $this->permissionRepository->create($data);
    }

    public function updatePermission(array $data,$id)
    {
        return $this->permissionRepository->update($data,$id);
    }

    public function deletePermission($id): int
    {
        return $this->permissionRepository->delete($id);
    }
}
