<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function findById($id)
    {
        return User::find($id);
    }

    public function getAllUsers($perPage = 10)
    {
        return User::paginate($perPage);
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }
}
