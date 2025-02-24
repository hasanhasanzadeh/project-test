<?php

namespace App\Services;


use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ForgotService
{
    public function getForgotPassword(array $data): bool
    {
            $user = User::where('mobile',$data['mobile'])->first();
            if (!$user) {
                return false;
            }
            $passwordReset = PasswordReset::where('user_id',$user->id)->where('code',$data['combined_digits'])->first();
            if (!$passwordReset) {
                return false;
            }
            return true;
    }

    public function resetPassword(array $data)
    {
            $user = User::where('mobile',$data['mobile'])->first();
            if (!$user) {
                return false;
            }
            $user->password = Hash::make($data['password']);
            $user->save();

            DB::table('password_resets')->where('user_id',$user->id)->delete();

            event(new EventAddNotification('بازنشانی کلمه عبور','کلمه عبور شما با موفقیت بازنشانی شد',$user->id));

            return $user;
    }

    public function store(array $data)
    {
            $user = User::where('mobile',$data['mobile'])->first();

            event(new EventForgotPassword($user));

            return $user;
    }
}
