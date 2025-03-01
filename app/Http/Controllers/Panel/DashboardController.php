<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Services\UserService;

class DashboardController extends Controller
{
    public function __construct(readonly private UserService $userService)
    {
    }

    public function index(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        if (!auth()->check()) {
            toast('شما باید اول وارد سایت شوید', 'warning');
            return redirect(route('login'));
        }
        $title = 'داشبورد';
        $user = $this->userService->getUserById(auth()->user()->id);
        return view('panel.dashboard.index', [
            'title' => $title,
            'user' => $user,
        ]);
    }
}
