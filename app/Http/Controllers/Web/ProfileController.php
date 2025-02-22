<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\AvatarRequest;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    public function __construct(readonly private UserService $userService
    )
    {
    }

    /**
     * Display the user's profile form.
     */
    public function show(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $user = $this->userService->getUserById(auth()->user()->id);
        $title = 'پروفایل من';
        return view('user.profile.show', [
            'user' => $user,
            'title' => $title
        ]);
    }

    public function referral(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $user = $this->userService->getUserById(auth()->user()->id);
        $title = 'معرفی دوستان';
        return view('user.referral.show', [
            'user' => $user,
            'title' => $title
        ]);
    }

    public function uploadAvatar(AvatarRequest $avatarRequest): JsonResponse
    {
        $profile = $this->userService->uploadAvatar($avatarRequest->validated());
        return response()->json(['status' => true, 'data' => $profile->data], 200);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $this->userService->updateProfile($request->validated());
        toast('اطلاعات با موفقیت ویرایش شد', 'success');
        return redirect()->back();
    }

}
