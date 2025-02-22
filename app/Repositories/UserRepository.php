<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function findById($id)
    {
        return User::find($id);
    }

    public function getAllUsers($perPage = 10,$search=null)
    {
        $users = User::query();
        if($search){
            $users = $users->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('mobile', 'LIKE', "%{$search}%");
        }
        return $users->sortable()->paginate($perPage);
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function updateUser(array $data,$id)
    {
        $user = User::find($id)->update($data);
        if (isset($data['avatar'])) {
            if ($user->avatar) {
                Helper::deleteFile($user->avatar->url);
                $user->avatar()->delete();
            }
            $path = str_replace('public', 'storage', $data['avatar']->store('public/avatars'));
            $user->avatar()->create(['path' => $path]);
        }
        return $user->fresh();
    }

    public function updateProfile(array $data)
    {
        $user = User::find(auth()->user()->id)->update($data);
        return $user->fresh();
    }

    public function deleteUser($id): int
    {
        return User::destroy($id);
    }
}
