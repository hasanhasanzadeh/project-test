<?php

namespace App\Http\Resources\User;

use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'users'=>$this->collection->map(function ($item){
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'email' => $item->email,
                    'created_at' => Verta::parse($item->created_at),
                ];
            }),
            'meta' => [
                'total' => $this->total(),
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'last_page' => $this->lastPage(),
            ],
        ];
    }
}
