<?php

namespace App\Services;

use App\Repositories\RoleRepository;

readonly class RoleService
{

    public function __construct(private RoleRepository $roleRepository)
    {
    }

    public function getRoleById($id)
    {
        return $this->roleRepository->find($id);
    }

    public function getAllRole($perPage,array $search=null): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->roleRepository->all($perPage,$search);
    }

    public function createRole(array $data): \Spatie\Permission\Contracts\Role|\Spatie\Permission\Models\Role
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
