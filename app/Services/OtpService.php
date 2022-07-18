<?php

namespace App\Services;

use App\Models\Otp;
use Error;

class OtpService
{
    private WhatsappService $whatsappService;

    public function __construct(WhatsappService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }

    public function createOtp(String $phoneNumber)
    {
        $code = $this->generateOtp(4);

        $otp = Otp::query()->create([
            'phone_number' => $phoneNumber,
            'code' => $code
        ]);

        if (!$otp) {
            throw new Error("Error creating OTP code");
        }

        return $otp;
    }

    private function generateOtp($n)
    {
        $generator = "1357902468";
        $result = "";

        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand() % (strlen($generator))), 1);
        }

        return $result;
    }

    public function sendOtp(Otp $otp)
    {
        $message = 'Code OTP: ' . $otp->code;
        try {
            $this->whatsappService->send($otp->phone_number, $message);
        } catch (Error $err) {
            throw $err;
        }
    }

    public function findByCode(String $code)
    {
        return Otp::query()->where('code', '=', $code)->latest()->first();
    }

    public function findByPhoneNumber(String $number)
    {
        return Otp::query()->where('phone_number', '=', $number)->latest()->first();
    }
}
