<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\VerifyMobileRequest;
use App\Models\ActivationCode;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class RegisteredUserController extends Controller
{
    public function __construct(readonly private UserService    $userService,
    )
    {
    }

    /**
     * Display the registration view.
     */
    public function create(): View|Factory|Application
    {
        return view('auth.register', [
            'title'=>'ثبت نام در سایت'
        ]);
    }


    /**
     * Display the introduction view.
     */
    public function introduction(): View|Factory|Application
    {
        return view('auth.intro', [
            'title'=>'معرفی سایت'
        ]);
    }

    public function verifyRegister(): Application|Factory|View|RedirectResponse
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

        $user = User::where('mobile', $auth['mobile'])->first();
        $time = ActivationCode::where('user_id', $user->id)->latest()->first()->value('expired_at');
        return view('auth.verify_mobile', ['time' => $time,'title'=>'تاییدیه موبایل']);
    }

    public function resendVerifyCode(): View|Factory|Application|RedirectResponse
    {
        $auth = request()->session()->get('auth');
        if (!request()->session()->has('auth') || auth()->check()) {
            toast('شما قبلا وارد سایت شده اید لطفا دباره تلاش کنید', 'error');
            return redirect()->route('index.welcome');
        }
        request()->session()->reflash();

        $mobile = request()->session()->get('auth')['mobile'];
        $user = User::where('mobile', $mobile)->first();
        if (!$user){
            toast('لطفا دوباره امتحان کنید', 'error');
            return redirect()->route('register');
        }
        DB::table('activation_codes')->where('user_id',$user->id)->delete();

        event(new EventVerificationCode($user));
        $time = ActivationCode::where('user_id', $user->id)->latest()->first()->value('expired_at');

        toast('کد تایید دوباره برای شما ارسال شد', 'success');
        return view('auth.verify_mobile', [ 'time' => $time,'title'=>'تاییدیه موبایل']);
    }

    public function verifyMobile(VerifyMobileRequest $verifyMobileRequest): RedirectResponse
    {
        try{
            if (auth()->check()) {
                toast('شما قبلا وارد سایت شده اید', 'error');
                return redirect()->route('index.welcome');
            }
            $auth = request()->session()->get('auth');
            request()->session()->reflash();
            $register = $this->userService->verify($auth, $verifyMobileRequest->combined_digits);
            if (!$register->data) {
                toast('کد تایید اشتباه می باشد لطفا دوباره امتحان کنید', 'warning');
                return redirect()->route('verify.register');
            }
            $user = User::findOrFail($register->data['id']);
            $user->mobile_verified_at = now();
            $user->save();
            toast('شما با موفقیت ثبت نام کردید', 'success');

            event(new EventLogin($user));
            event(new EventAddNotification('ثبت نام','شما با موفقیت در سایت ثبت نام کردید',$user->id));

            Auth::loginUsingId($register->data['id']);
            return redirect(route('dashboard.user'));
        }catch (Exception $exception){
            toast($exception->getMessage(), 'error');
            return redirect()->back();
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = $this->userService->registerUser($request->validated());
        if (!$user) {
            Alert::warning('هشدار', 'ثبت نام انجام نشد لطفا دوباره تلاش کنید');
            return back(route('register'));
        }
        $request->session()->flash('auth', ['mobile' => $request->mobile]);
        return redirect(route('verify.register'));
    }
}
