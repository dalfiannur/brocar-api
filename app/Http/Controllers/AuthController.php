<?php

namespace App\Http\Controllers;

use App\Helpers\PhoneNumberHelper;
use App\Http\Requests\Auth\{
    LoginRequest,
    LoginSocialMediaRequest,
    RegisterRequest
};
use App\Services\UserService;
use Error;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\UnauthorizedException;
use Kreait\Firebase\Contract\Auth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;
use Kreait\Firebase\Exception\Auth\PhoneNumberExists;

class AuthController extends Controller
{
    public function login(LoginRequest $request, Auth $auth, UserService $service): JsonResponse
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

    public function loginSocialMedia(LoginSocialMediaRequest $request, Auth $auth, UserService $service): JsonResponse
    {
        $token = $request->input("access_token");

        try {
            $verifyIdToken = $auth->verifyIdToken($token);
            $uid = $verifyIdToken->claims()->get('sub');

            $user = $service->findUserByUid($uid);

            if (!$user) {
                return response()->json([
                    'code' => 404,
                    'message' => "User not found"
                ], 422);
            }

            FacadesAuth::setUser($user);

            return response()->json([
                'code' => 200,
                'message' => 'Login Successfully',
                'data' => $user
            ]);
        } catch (FailedToVerifyToken $e) {
            return response()->json([
                'code' => 422,
                'message' => "The token is expired"
            ], 422);
        }
    }

    public function register(RegisterRequest $request, UserService $service, Auth $auth)
    {
        $phone_number = PhoneNumberHelper::format($request->phone_number, 'id');

        try {
            $firebaseUser = $auth->createUser([
                'displayName' => $request->name,
                'password' => $request->password,
                'phoneNumber' => $phone_number,
                'email' => substr($phone_number, 1) . '@brocar.id',
                'emailVerified' => true
            ]);
        } catch (PhoneNumberExists $e) {
            return response()->error($e->getMessage(), 422);
        }


        try {
            $user = $service->createUser([
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'pin' => Hash::make($request->pin),
                'phone_number' => $phone_number,
                'role_id' => $request->role == 'agent' ? 2 : 3
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'User register successfully',
                'data' => $user
            ]);
        } catch (Error $error) {
            $auth->deleteUser($firebaseUser->uid);

            return response()->json([
                'code' => 400,
                'message' => $error->getMessage()
            ], 400);
        }
    }

    public function registerSocialMedia()
    {
    }
}
