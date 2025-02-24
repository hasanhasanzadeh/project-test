<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function all($search);
    public function find($id);
    public function create(array $array);
    public function update(array $data,$id);
    public function delete($id);

    public function findByNationalCode($nationalCode);
    public function updateProfile(array $data);
}
