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
        return $this->roleRepository->find($id);
    }

    public function getAllRole($perPage,array $search=null)
    {
        return $this->roleRepository->all($perPage,$search);
    }

    public function createRole(array $data)
    {
        return $this->roleRepository->create($data);
    }

    public function updateRole(array $data,$id)
    {
        return $this->roleRepository->update($data,$id);
    }

    public function deleteRole($id): int
    {
        return $this->roleRepository->delete($id);
    }
}
