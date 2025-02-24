<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function find($id)
    {
        return User::find($id);
    }

    public function findByNationalCode($nationalCode)
    {
        return User::where('national_code',$nationalCode)->first();
    }

    public function all($search = null)
    {
        $users = User::query();
        if (isset($search['search'])) {
            $users = $users->where('name', 'LIKE', "%{$search['search']}%")
                ->orWhere('email', 'LIKE', "%{$search['search']}%")
                ->orWhere('mobile', 'LIKE', "%{$search['search']}%");
        }
        return $users->sortable()->paginate(10);
    }

    public function create(array $array)
    {
        return User::create($array);
    }

    public function update(array $data, $id)
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

    public function delete($id): int
    {
        return User::destroy($id);
    }
}
