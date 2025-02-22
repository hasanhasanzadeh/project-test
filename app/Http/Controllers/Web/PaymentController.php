<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function pay(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'shaba' => 'required|ir_sheba', // شماره شبا ۲۴ رقمی
            'amount' => 'required|numeric|min:1000', // حداقل پرداخت ۱۰۰۰ تومان
        ]);

        $result = $this->paymentService->makePayment($request->iban, $request->amount);

        return response()->json($result, $result['success'] ? 200 : 400);
    }
}
