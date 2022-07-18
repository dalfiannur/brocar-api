<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Kreait\Firebase\Contract\Auth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class JwtMiddleware
{

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('Authorization')) {
            try {
                $token = substr($request->header('Authorization'), 7);
                $verifyIdToken = $this->auth->verifyIdToken($token);
                dd($verifyIdToken);
                return $next($request);
            } catch (FailedToVerifyToken $e) {
                throw new UnauthorizedException('The token is invalid: ' . $e->getMessage());
            }

            return $next($request);
        }

        throw new UnauthorizedException('Invalid authorization');
    }
}
