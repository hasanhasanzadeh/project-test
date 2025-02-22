<?php

namespace App\Services;

use App\Repositories\PaymentRepository;

class PaymentService
{
    protected PaymentRepository $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function makePayment($iban, $amount): array
    {
        return $this->paymentRepository->processPayment($iban, $amount);
    }
}
