<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::toUser($request->input('token'));
        } catch (JWTException $exception) {
            if ($exception instanceof TokenExpiredException) {
                return response()->json(['token expired'], $exception->getStatusCode());
            } elseif ($exception instanceof TokenInvalidException) {
                return response()->json(['token invalid'], $exception->getStatusCode());
            } else {
                return response()->json(['error' => 'Token required']);
            }
        }
        return $next($request);
    }
}
