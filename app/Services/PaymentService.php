<?php

namespace App\Services;

use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\PaymentRepository;

readonly class PaymentService
{
    public function __construct(private PaymentRepositoryInterface $paymentRepository)
    {
    }

    public function makePayment($iban, $amount): array
    {
        return $this->paymentRepository->processPayment($iban, $amount);
    }
}
