<?php

namespace App\Repositories\Interfaces;

interface CostRepositoryInterface
{
    public function all($search);
    public function find($id);
    public function create(array $array);
    public function update(array $data,$id);
    public function delete($id);
}
