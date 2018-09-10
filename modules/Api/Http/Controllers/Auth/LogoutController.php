<?php

namespace Modules\Api\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Modules\Api\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;
use Cookie;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTFactory;
use App\Entities\Models\User;
class LogoutController extends ApiController
{
    private $_modelUser;
    public function __construct()
    {
        $this->_modelUser = new User();
    }
    
    public function logout(Request $request)
    {
        if (!$request->isMethod('post')) {
            return $this->respondWithError(101);
        }
        if(!$request->access_token){
            return $this->respondWithError(103,'access_token');
        }
        $userInfo = $this->_modelUser->getUserInfoByUserAccessToken($request->access_token);
        if(empty($userInfo)){
            return $this->respondWithError(106);
        }
        
        $factory = JWTFactory::addClaims([
            'wallet_user_id' => $userInfo['appota_user_id'],
            'sub'   => env('API_ID'),
            'iss'   => config('app.name'),
            'iat'   => time(),
            'exp'   => JWTFactory::getTTL(),
            'nbf'   => time(),
            'jti'   => uniqid(),
        ]);
        $payload = $factory->make();
        $token = JWTAuth::encode($payload);

        $paramUpdateUser = [
            'access_token' => $token,
            'updated_at' => time(),
        ];
        $this->_modelUser->updateUser($paramUpdateUser,$userInfo['appota_user_id']);
            
        $message = 'success';
        $errorCode = 0;
        return $this->respondData($message,$errorCode);
    }

//    public function logout(Request $request) {
//        $this->validate($request, ['token' => 'required']);
//
//        try {
//            JWTAuth::invalidate($request->input('token'));
//            return response()->json(['success' => true, 'message'=> "You have successfully logged out."]);
//        } catch (JWTException $e) {
//            // something went wrong whilst attempting to encode the token
//            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
//        }
//    }
}
