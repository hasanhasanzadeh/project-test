<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Models\ActivationCode;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\UserNotification;
use App\Services\ForgotService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class PasswordResetController extends Controller
{
    public function __construct(private readonly ForgotService $forgotService)
    {
    }

    /**
     * Display the password reset link request view.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $title = 'فراموش کردن کلمه عبور';
        return view('auth.forgot-password',[
            'title' => $title,
        ]);
    }

    public function resend(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $auth = request()->session()->get('auth');
        request()->session()->reflash();
        $user = User::where('mobile', $auth['mobile'])->first();
        DB::table('password_resets')->where('user_id',$user->id)->delete();

        $code=PasswordReset::createCode($user)->code;
        $message = 'کد تایید شما '.$code;
        $user->notify(new UserNotification($message, 'کد تایید', 'all'));

        $time = PasswordReset::where('user_id', $user->id)->latest()->first()->value('expired_at');

        toast('کد تایید دباره برای شما ارسال شد', 'success');
        return view('auth.reset-password', ['time' => $time,'title'=>'بازنشانی کلمه عبور']);
    }

    /**
     * Handle an incoming password reset link request.
     *
     */
    public function store(ForgotPasswordRequest $request): RedirectResponse
    {
        $forgotPassword = $this->forgotService->store($request->validated());
        if (!$forgotPassword) {
            toast('درخواست شما انجام نشد لطفا بعد از مدتی دباره سعی کنید','error');
        }else{
            toast('درخواست شما انجام شد لطفا کلمه عبور جدید را بازنشانی کنید','success');
        }
        $request->session()->flash('auth', ['mobile' => $request->mobile]);
        request()->session()->reflash();
        return redirect()->route('password.show');
    }

}
