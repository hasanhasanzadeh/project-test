<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SendRequestCode;
use App\Http\Requests\Auth\VerifyOtpFormRequest;
use App\Http\Requests\Auth\VerifyOtpRequest;
use App\Services\ForgotService;
use App\Services\SettingService;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{

    public function __construct(private readonly ForgotService $forgotService)
    {
    }

    public function showForgotPasswordForm(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        if (auth()->check()){
            toast('درخواست مورد نظر یافت نشد لطفا دباره تلاش کنید','warning');
            return redirect()->route('index.welcome');
        }

        $title = 'درخواست بازنشانی کلمه عبور';
        return view('auth.passwords.forgot',[
            'title'=>$title
        ]);
    }

    // Send OTP to the user's mobile number
    public function sendResetToken(SendRequestCode $request): \Illuminate\Http\RedirectResponse
    {
        $forgot = $this->forgotService->store($request->validated());
        if (!$forgot){
            toast('درخواست مورد نظر یافت نشد','error');
            return redirect()->back();
        }
        $request->session()->put('auth', ['mobile' => $request->mobile]);
        request()->session()->reflash();

        return redirect()->route('password.verify_otp_form')->with('mobile',$request->mobile);
    }

    // Show the form to verify the OTP
    public function showVerifyOtpForm(VerifyOtpFormRequest $request): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        $auth = $request->session()->get('auth', ['mobile' => $request->mobile]);
        if (auth()->check()|| !$auth){
            toast('درخواست مورد نظر یافت نشد لطفا دباره تلاش کنید','warning');
            return redirect()->route('index.welcome');
        }
        request()->session()->reflash();

        return view('auth.passwords.verify',[
            'title'=>'درخواست بازنشانی کلمه عبور',
            'mobile'=>$request->mobile
        ]);
    }

    // Verify the OTP and redirect to reset password form
    public function verifyOtp(VerifyOtpRequest $request): \Illuminate\Http\RedirectResponse
    {
        $forgot = $this->forgotService->getForgotPassword($request->validated());
        $request->session()->get('auth', ['mobile' => $request->mobile]);
        request()->session()->reflash();
        if (!$forgot->data) {
            toast('کد تایید اشتباه می باشد لطفا دوباره تلاش کنید','error');
            return redirect()->route('password.request')->with(['mobile'=>$request->mobile]);
        }
        toast('لطفا کلمه عبور خود را بازنشانی کنید','success');
        return redirect()->route('password.reset_form')->with(['mobile' => $request->mobile]);
    }

    // Show the reset password form
    public function showResetPasswordForm(Request $request): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
    {
        $auth = $request->session()->get('auth', ['mobile' => $request->mobile]);
        if (auth()->check()|| !$auth){
            toast('درخواست مورد نظر یافت نشد لطفا دباره تلاش کنید','warning');
            return redirect()->route('index.welcome');
        }
        request()->session()->reflash();

        return view('auth.passwords.reset',[
            'title'=>'درخواست بازنشانی کلمه عبور',
            'mobile'=>$request->mobile
        ]);
    }

    // Reset the user's password
    public function resetPassword(ResetPasswordRequest $request): \Illuminate\Http\RedirectResponse
    {
        $rest = $this->forgotService->resetPassword($request->validated());
        if (!$rest->data) {
            $request->session()->get('auth', ['mobile' => $request->mobile]);
            request()->session()->reflash();
            toast('درخواست شما قابل اجرا نیست لطفا دوباره تلاش کنید','error');
            return redirect()->back()->with(['mobile'=>$request->mobile]);
        }
        toast('کلمه عبور شما با موفقیت بازنشانی شد','success');
        return redirect()->route('login');
    }
}
