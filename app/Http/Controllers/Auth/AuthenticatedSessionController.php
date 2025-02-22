<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\VerifyMobileRequest;
use App\Models\ActivationCode;
use App\Models\User;
use App\Notifications\UserNotification;
use App\Services\UserService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthenticatedSessionController extends Controller
{
    public function __construct(readonly private UserService $userService)
    {
    }

    /**
     * Display the login view.
     */
    public function create(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('auth.login',[
            'title'=>'ورود به وب سایت'
        ]);
    }

    public function verify(Request $request): Application|Factory|\Illuminate\Contracts\View\View|RedirectResponse
    {
        $user = User::where('mobile',request()->session()->get('auth')['mobile'])->first();
        if (!request()->session()->has('auth') || auth()->check() || empty($user)) {
            toast('لطفا از طریق صفحه ورود وارد شوید', 'error');
            return redirect()->route('index.welcome');
        }
        request()->session()->reflash();

        $activationCode = ActivationCode::createCode($user)->code;
        $message = 'کد تایید شما '.$activationCode;
        $user->notify(new UserNotification($message, 'تایید موبایل', 'email'));

        $time = ActivationCode::where('user_id', $user->id)->latest()->first()->value('expired_at');
        toast('کد تایید برای شما ارسال شد','success');
        return view('auth.verified_mobile', ['time' => $time,'title'=>'تاییدیه موبایل']);
    }
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $user = User::where('mobile',$request->mobile)->firstOrFail();
        $auth = password_verify($request->password, $user->password);
        if (!$auth) {
            toast('شماره موبایل یا کلمه عبور شما اشتباه می باشد','error');
            return redirect()->back();
        }
        if ($user->mobile_verified_at == null && $auth ) {
            request()->session()->flash('auth', ['mobile' => $user->mobile]);
            toast('لطفا اول موبایل خود را تایید کنید','success');
            return redirect()->route('verified.mobile');
        }
        $request->authenticate();
        $request->session()->regenerate();

        $message = 'شما با موفقیت وارد سایت شدید';
        $user->notify(new UserNotification($message, 'ورود', 'email'));

        return redirect()->intended(route('dashboard.user', absolute: false));
    }

    public function resendVerifiedCode(): \Illuminate\Contracts\View\View|Factory|Application|RedirectResponse
    {
        if (!request()->session()->has('auth') || auth()->check()) {
            toast('شما قبلا وارد سایت شده اید لطفا دباره تلاش کنید', 'error');
            return redirect()->route('index.welcome');
        }
        request()->session()->reflash();

        $mobile = request()->session()->get('auth')['mobile'];
        $user = User::where('mobile', $mobile)->first();
        if (!$user){
            toast('لطفا دوباره امتحان کنید', 'error');
            return redirect()->back();
        }
        DB::table('activation_codes')->where('user_id',$user->id)->delete();

        $activationCode = ActivationCode::createCode($user)->code;
        $message = 'کد تایید شما '.$activationCode;
        $user->notify(new UserNotification($message, 'تایید موبایل', 'mobile'));

        $time = ActivationCode::where('user_id', $user->id)->latest()->first()->value('expired_at');

        toast('کد تایید دوباره برای شما ارسال شد', 'success');
        return view('auth.verified_mobile', [ 'time' => $time,'title'=>'تاییدیه موبایل']);
    }

    public function verifiedMobile()
    {
        $auth = request()->session()->get('auth');
        if (!request()->session()->has('auth') || auth()->check()) {
            return redirect()->route('index.welcome');
        }
        if (auth()->check() || !$auth) {
            toast(__('dashboard.warning'), 'error');
            return redirect()->route('index.welcome');
        }
        request()->session()->reflash();

        $mobile = request()->session()->get('auth')['mobile'];
        $user = User::where('mobile', $mobile)->first();
        $time = ActivationCode::where('user_id', $user->id)->latest()->first()->value('expired_at');

        return view('auth.verified_mobile', ['time' => $time,'title'=>'تاییدیه موبایل']);
    }

    public function verifiedCode(VerifyMobileRequest $verifyMobileRequest): RedirectResponse
    {
        try {
            if (auth()->check()) {
                toast('شما قبلا وارد سایت شده اید', 'error');
                return redirect()->route('index.welcome');
            }
            $auth = request()->session()->get('auth');
            request()->session()->reflash();

            $register = $this->userService->verify($auth, $verifyMobileRequest->combined_digits);
            if (!$register) {
                toast('کد تایید اشتباه می باشد لطفا دوباره امتحان کنید', 'warning');
                request()->session()->reflash();
                return redirect()->route('verified.mobile');
            }

            $user = User::findOrFail($register->id);
            $user->mobile_verified_at = now();
            $user->save();

            toast('شما با موفقیت وارد سایت شدید', 'success');

            Auth::loginUsingId($register->id);
            return redirect(route('dashboard.user'));
        }catch (Exception $exception){
            toast($exception->getMessage(), 'error');
            return redirect()->back();
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect('/');
    }
}
