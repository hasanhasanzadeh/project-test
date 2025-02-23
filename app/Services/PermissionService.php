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
        return $this->permissionRepository->findById($id);
    }

    public function getAllPermisions($perPage,array $search=null)
    {
        return $this->permissionRepository->getAllPermissions($perPage,$search);
    }

    public function createPermission(array $data)
    {
        return $this->permissionRepository->createPermission($data);
    }

    public function updatePermission(array $data,$id)
    {
        return $this->permissionRepository->updatePermission($data,$id);
    }

    public function deletePermission($id): int
    {
        return $this->permissionRepository->deletePermission($id);
    }
}
