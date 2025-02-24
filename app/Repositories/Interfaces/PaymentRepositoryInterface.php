<?php

namespace App\Repositories\Interfaces;

interface PaymentRepositoryInterface
{
    public function getBankByIban($iban);

    public function processPayment($iban, $amount);
}
