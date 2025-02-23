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

    public function findByNationalCode($nationalCode)
    {
        return User::where('national_code',$nationalCode)->first();
    }

    public function getAllUsers($search = null)
    {
        $users = User::query();
        if (isset($search['search'])) {
            $users = $users->where('name', 'LIKE', "%{$search['search']}%")
                ->orWhere('email', 'LIKE', "%{$search['search']}%")
                ->orWhere('mobile', 'LIKE', "%{$search['search']}%");
        }
        return $users->sortable()->paginate(10);
    }

    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function updateUser(array $data, $id)
    {
        $user = User::with('avatar')->find($id);
        $user->update($data);
        if (isset($data['avatar'])) {
            if ($user->avatar) {
                Helper::deleteFile($user->avatar->url);
                $user->avatar()->delete();
            }
            $path = str_replace('public', 'storage', $data['avatar']->store('public/avatars'));
            $user->avatar()->create(['path' => $path]);
        }
        return $user;
    }

    public function updateProfile(array $data)
    {
        $customer = User::with('avatar')->find(auth()->user()->id);
        $user = $customer->update($data);
        if (isset($data['avatar'])) {
            if ($customer->avatar) {
                Helper::deleteFile($customer->avatar->url);
                $customer->avatar()->delete();
            }
            $path = str_replace('public', 'storage', $data['avatar']->store('public/avatars'));
            $customer->avatar()->create(['path' => $path]);
        }

        return $customer;
    }

    public function deleteUser($id): int
    {
        return User::destroy($id);
    }
}
