<?php

namespace App\Services;

use App\Repositories\PermissionRepository;

class PermissionService
{
    protected PermissionRepository $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function getPermissionById($id)
    {
        return $this->permissionRepository->find($id);
    }

    public function getAllPermisions($perPage,array $search=null)
    {
        return $this->permissionRepository->all($perPage,$search);
    }

    public function createPermission(array $data)
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
