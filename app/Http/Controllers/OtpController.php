<?php

namespace App\Http\Controllers;

use App\Services\OtpService;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class OtpController extends Controller
{
    public function request(OtpService $service, Request $request)
    {
        $phoneNumber = $request->input('phone_number');

        try {
            $otp = $service->createOtp($phoneNumber);
            $service->sendOtp($otp);

            return response()->json([
                'status' => 200,
                'message' => 'OTP Code successfully sended'
            ]);
        } catch (Error $err) {
            return response()->json([
                'status' => 500,
                'message' => $err->getMessage()
            ], 500);
        }
    }

    public function verify(OtpService $service, Request $request)
    {
        $otp = $service->findByPhoneNumber($request->input('phone_number'));

        if (!$otp) {
            return response()->json([
                'status' => '400',
                'message' => 'Invalid code'
            ], 400);
        }

        if ($otp->code != $request->input('code')) {
            return response()->json([
                'status' => '400',
                'message' => 'Invalid code'
            ], 400);
        }
        
        if (Carbon::createFromDate($otp->created_at)->diffInMinutes(new Carbon()) > 1) {
            return response()->json([
                'status' => '422',
                'message' => 'OTP Expired'
            ], 422);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Code verified'
        ]);
    }
}
