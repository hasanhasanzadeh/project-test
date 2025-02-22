<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(readonly private UserService    $userService,
    )
    {
    }

    public function dashboard(Request $request)
    {
        if (!auth()->check()) {
            toast('شما باید اول وارد سایت شوید', 'warning');
            return redirect(route('login'));
        }
        $title = 'داشبورد';
        $user = $this->userService->getUserById(auth()->user()->id);
        return view('user.dashboard.index', [
            'title' => $title,
            'user' => $user,
        ]);
    }

}
