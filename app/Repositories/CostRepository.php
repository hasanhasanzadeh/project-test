<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Models\Cost;


class CostRepository
{
    public function findById($id,$auth=false)
    {
        if($auth){
            return Cost::with(['category','costFile'])->where('user_id',auth()->id())->find($id);
        }
        return Cost::with(['category','costFile'])->find($id);
    }

    public function findByIdWithUserId($id,$user_id)
    {
        return Cost::with(['category','costFile'])->where('user_id',$user_id)->find($id);
    }

    public function getAllCosts($search=null,$auth=false)
    {
        $costs = Cost::query();
        if($auth){
            $costs = $costs->where('user_id',auth()->user()->id);
        }
        if(isset($search['search'])){
            $costs = $costs->where('name', 'LIKE', "%{$search['search']}%");
        }
        return $costs->sortable()->paginate(10);
    }

    public function createCost(array $data)
    {
        return Cost::create($data);
    }

    public function deleteCost($id): int
    {
        return Cost::destroy($id);
    }

    public function updateCost(array $data,$id)
    {
        return Cost::find($id)->update($data);
    }
}
