<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Repositories\CostRepository;

class CostService
{
    protected CostRepository $costRepository;

    public function __construct(CostRepository $costRepository)
    {
        $this->costRepository = $costRepository;
    }

    public function getCostById($id,$auth=false)
    {
        return $this->costRepository->find($id,$auth);
    }

    public function getCostByIdWithoutAuth($id,$user_id)
    {
        return $this->costRepository->findByIdWithUserId($id,$user_id);
    }

    public function getAllCosts(array $search=null,$auth=false)
    {
        return $this->costRepository->all($search,auth:$auth);
    }

    public function createCost(array $data)
    {
        $data['user_id'] = auth()->user()->id;
        if (isset($data['cost_file'])) {
            $data['cost_file_id'] = Helper::uploadImageVerify($data['cost_file']);
        }
        return $this->costRepository->create($data);
    }

    public function updateCost(array $data,$id)
    {
        return $this->costRepository->update($data,$id);
    }

    public function deleteCost($id): int
    {
        return $this->costRepository->delete($id);
    }
}
