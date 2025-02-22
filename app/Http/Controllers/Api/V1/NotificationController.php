<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiResponse;
use App\Http\ApiRequests\Notification\NotificationApiRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function sendNotification(NotificationApiRequest $request): JsonResponse
    {
        $user = User::findOrFail($request->user_id);

        if (!$user->email && !$user->phone_number) {
            return ApiResponse::error('User has no email or phone number', [], 400);
        }

        $user->notify(new UserNotification($request->message, $request->subject, $request->type));

        return ApiResponse::success([], 'Notification sent successfully');
    }
}
