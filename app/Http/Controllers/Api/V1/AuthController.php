<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiResponse;
use App\Http\ApiRequests\LoginApiRequest;
use App\Http\ApiRequests\RegisterApiRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Notifications\UserNotification;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterApiRequest $request): JsonResponse
    {
        $user = $this->userService->registerUser($request->all());
        $token = $user->createToken('auth_token')->plainTextToken;

        // Send Welcome Email & SMS
        $message = "Welcome, " . $user->name . "! Your account has been successfully created.";
        $user->notify(new UserNotification($message, "Welcome!", "all"));

        return ApiResponse::success([
            'user' => new UserResource($user),
            'token' => $token,
        ], 'User registered successfully');
    }

    public function login(LoginApiRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return ApiResponse::error('Invalid credentials', [], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        // Send Welcome Email & SMS
        $message = "Hello " . $user->name . ", you have successfully logged into your account.";
        $user->notify(new UserNotification($message, "Login Alert", "all"));

        return ApiResponse::success([
            'user' => new UserResource($user),
            'token' => $token,
        ], 'Login successful');
    }

    public function profile(): JsonResponse
    {
        return ApiResponse::success([
            'user' => new UserResource(Auth::user()),
        ], 'Get Profile successful');
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return ApiResponse::success([], 'User logged out successfully');
    }

}
