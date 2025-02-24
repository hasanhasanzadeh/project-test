<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PaymentRepositoryInterface;
use Illuminate\Support\Facades\Http;

class PaymentRepository implements PaymentRepositoryInterface
{
    protected mixed $banks;

    public function __construct()
    {
        $this->banks = config('banks.banks');
    }

    /**
     * شناسایی بانک بر اساس شماره شبا
     */
    public function getBankByIban($iban)
    {
        $bankCode = substr($iban, 0, 2); // دریافت دو رقم اول شماره شبا

        return $this->banks[$bankCode] ?? null;
    }

    /**
     * انجام پرداخت از حساب شرکت به حساب کاربر
     */
    public function processPayment($iban, $amount): array
    {
        $bank = $this->getBankByIban($iban);

        if (!$bank) {
            return ['success' => false, 'message' => 'بانک نامعتبر است.'];
        }

        // شبیه‌سازی فراخوانی API بانک (در حالت واقعی این درخواست به API ارسال می‌شود)
        // return Http::post($bank['api_url'], [
        //     'company_account' => '1234567890123456', // شماره حساب شرکت
        //     'user_iban' => $iban,
        //     'amount' => $amount,
        // ]);

        return ['success' => true, 'message' => 'پرداخت با موفقیت انجام شد.', 'bank' => $bank['name']];
    }
}
