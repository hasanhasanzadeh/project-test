<?php

namespace App\Http\Controllers\Web;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\CostService;
use App\Services\PaymentService;
use App\Services\UserService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function __construct(private readonly UserService $userService,private readonly CostService $costService,private readonly PaymentService $paymentService)
    {}

    public function pay(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = $this->userService->getUserByNationalCode($request->national_code);
        $cost = $this->costService->getCostByIdWithoutAuth($request->id,$user->id);
        if (!$user || !$cost) {
            return ApiResponse::error(message: 'Payment Not Found', errors: ['Payment Not Found'], code: 404);
        }
        $result = $this->paymentService->makePayment($cost->shaba, $cost->amount);
        if (!$result) {
            $cost = $this->costService->updateCost(['status'=>'fail'],$cost->id);
            return ApiResponse::error(message: 'Payment Fail', errors: ['Payment Fail'], code: 203);
        }
        $cost = $this->costService->updateCost(['status'=>'done'],$cost->id);
        return ApiResponse::success(data: $cost, message: 'Payment Success', code: 200);
    }
}
