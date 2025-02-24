<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Models\ActivationCode;
use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

readonly class UserService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function getUserById($id)
    {
        return $this->userRepository->find($id);
    }

    public function getUserByNationalCode($nationalCode)
    {
        return $this->userRepository->findByNationalCode($nationalCode);
    }

    public function getAllUsers($perPage,array $search=null)
    {
        return $this->userRepository->all($perPage,$search);
    }

    public function registerUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->create($data);
    }

    public function updateUser(array $data,$id)
    {
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        }
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });
        return $this->userRepository->update($data,$id);
    }

    public function updateProfile(array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });
        return $this->userRepository->updateProfile($data);
    }

    public function deleteUser($id): int
    {
        return $this->userRepository->delete($id);
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
