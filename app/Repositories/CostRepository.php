<?php

namespace App\Repositories;


use App\Models\Cost;
use App\Repositories\Interfaces\CostRepositoryInterface;


class CostRepository implements CostRepositoryInterface
{
    public function find($id,$auth=false)
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

    public function all($search=null,$auth=false)
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

    public function create(array $array)
    {
        return Cost::create($array);
    }

    public function delete($id): int
    {
        return Cost::destroy($id);
    }

    public function update(array $data,$id)
    {
        return Cost::find($id)->update($data);
    }
}
