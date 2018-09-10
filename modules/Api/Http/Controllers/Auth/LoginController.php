<?php

namespace Modules\Api\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Modules\Api\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;
use App\Common\Gamota\RequestApi;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTFactory;
use App\Entities\Models\User;
use Hash;

class LoginController extends ApiController
{
    private $_modelUser;

    public function __construct()
    {
        $this->_modelUser = new User();
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            $token = JWTAuth::attempt($credentials, [
                'exp' => now()->addWeek()->timestamp
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$token) {
                throw new \Exception('Could not authenticate');
            }

            return response()->json([
                'data' => $request->user(),
                'token' => $token
            ]);
        } catch (\Throwable $exception) {
            return response()->json($exception->getMessage());
        }

        return response()->json($request->all());
    }
}
