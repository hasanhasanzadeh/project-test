<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService
{
    protected RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getRoleById($id)
    {
        return $this->roleRepository->findById($id);
    }

    public function getAllRole($perPage,array $search=null)
    {
        return $this->roleRepository->getAllRoles($perPage,$search);
    }

    public function createRole(array $data)
    {
        return $this->roleRepository->createRole($data);
    }

    public function updateRole(array $data,$id)
    {
        return $this->roleRepository->updateRole($data,$id);
    }

    public function deleteRole($id)
    {
        return $this->roleRepository->deleteRole($id);
    }
}
