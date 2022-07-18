<?php

namespace App\Modules\Auth\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\PhoneNumberHelper;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $phone_number = PhoneNumberHelper::format($request->phone_number);
        $pin = $request->pin;

        $user = $service->findByUsername($phone_number);

        if (!$user) {
            throw new UnauthorizedException('Invalid credentials');
        }

        if (!Hash::check($pin, $user->pin)) {
            throw new UnauthorizedException('Invalid credentials');
        }

        try {
            $u = $auth->getUserByPhoneNumber($phone_number);
            // dd($auth->getEmailVerificationLink($u->email));
            $uid = $u->uid;
        } catch (\Exception $e) {
            if (Str::contains($e->getMessage(), 'No user')) {
                $u = $auth->createUser([
                    'phoneNumber' => $phone_number
                ]);

                $uid = $u->id;
                $user->uid = $u->uid;
                $user->save();
            }
        }

        return response()->json([
            'status' => 201,
            'message' => 'Login successfully',
            'data' => [
                'access_token' => $auth->createCustomToken($uid)->toString()
            ]
        ]);
    }
}
