<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function show($id): JsonResponse
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return ApiResponse::error('User not found', [], 404);
        }

        return ApiResponse::success(new UserResource($user), 'User retrieved successfully');
    }

    public function index(): JsonResponse
    {
        $users = $this->userService->getAllUsers(10);
        return ApiResponse::success(new UserCollection($users), 'Users retrieved successfully');
    }
}
