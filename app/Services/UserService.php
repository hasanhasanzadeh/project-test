<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Models\ActivationCode;
use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUserById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function getAllUsers($perPage,array $search=null)
    {
        return $this->userRepository->getAllUsers($perPage,$search);
    }

    public function registerUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->createUser($data);
    }

    public function updateUser(array $data,$id)
    {
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        }
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });
        return $this->userRepository->updateUser($data,$id);
    }

    public function updateProfile(array $data)
    {
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        }
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });
        return $this->userRepository->updateProfile($data);
    }

    public function deleteUser($id): int
    {
        return $this->userRepository->deleteUser($id);
    }

    public function uploadAvatar(array $data)
    {
            $user = User::with('avatar')->find(auth()->user()->id);
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

    public function verify(array $data,string $code)
    {
            $user = User::where('mobile',$data['mobile'])->first();
            if (!$user) {
                return false;
            }
            $activationCode = ActivationCode::where('user_id', $user->id)->where('code', $code)->first();
            if (!$activationCode) {
                return false;
            } elseif ($activationCode->expired_at < Carbon::now()) {
                return false;
            } elseif ($activationCode->used) {
                return false;
            }
//            $activationCode->delete();
            return $user;
    }

}
