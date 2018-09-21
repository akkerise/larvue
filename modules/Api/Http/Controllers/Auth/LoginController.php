<?php

namespace Modules\Api\Http\Controllers\Auth;

use Modules\Api\Http\Controllers\ApiController;
use App\Common\Untils\AppotaAPI;
use App\Entities\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Common\Gamota\RequestApi;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Facades\JWTAuth;
use Hash;

class LoginController extends ApiController
{
    private $_modelUser;
    protected $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }

    public function login(Request $request)
    {
        if (!$request->isMethod('post')) {
            return $this->respondWithError(101);
        }
//        $credentials = [
//            'email' => $request->email,
//            'password' => $request->password
//        ];

        $credentials = [
            'username' => 'nampv1992',
            'password' => '15051992'
        ];
        $res = RequestApi::create(AppotaAPI::login(), $credentials, 'POST');
        $dats = json_decode($res, true);

        if (empty($dats)) {
            return $this->respondWithError(106);
        }
        if (empty($dats['access_token'])) {
            return $this->respondWithError(106);
        }
        $accessToken = $dats['access_token'];

        $userInfo = $this->getUserInfoAppota($accessToken, null);
        $user = $this->userService->get()->where('email', $request->email)->first();

        if(empty($userInfo) || empty($user)){
            return $this->respondWithError(106);
        }

        if ($this->checkKeySign($request)) {
            return $this->respondWithError(105);
        }

        return $this->respondData('Success', 0, ['info' => $dats]);
    }

    public function facebook(Request $request)
    {
        if (!$request->isMethod('post')) {
            return $this->respondWithError(101);
        }

        if (!$request->facebook_access_token) {
            return $this->respondWithError(103, 'token');
        }

        $avatar = "";
        if ($request->avatar) {
            $avatar = $request->avatar;
        }

        $end_point = AppotaAPI::facebook();
        $api_params = array(
            'facebook_access_token' => $request->facebook_access_token
        );
        $respone = RequestApi::create($end_point, $api_params, 'POST');
        $data = json_decode($respone, true);

        if (empty($data)) {
            return $this->respondWithError(106);
        }

        if (!isset($data['data']['access_token'])) {
            return $this->respondWithError(106);
        }

        $access_token = $data['data']['access_token'];
        $infoUser = $this->getUserInfoAppota($access_token, $avatar);
        if (!$infoUser) {
            return $this->respondWithError(106);
        }

        $responeData = $infoUser;
        $message = 'success';
        $errorCode = 0;
        return $this->respondData($message, $errorCode, $responeData);
    }

    public function google(Request $request)
    {

    }

    private function getUserInfoAppota($accessToken, $avatar)
    {
        $end_point = AppotaAPI::userInfo();
        $api_params = array(
            'access_token' => $accessToken
        );
        $response = RequestApi::create($end_point, $api_params, 'GET');
        $data = json_decode($response, true);
        if (empty($data)) {
            return false;
        }
        $uAvatar = $avatar;
        if (!empty($data['data']['avatar'])) {
            $uAvatar = $data['data']['avatar'];
        }
        $mapData = array(
            'user_id' => $data['data']['user_id'],
            'username' => $data['data']['username'],
            'email' => $data['data']['email'],
            'phone_number' => $data['data']['phone'],
            'fullname' => $data['data']['fullname'],
            'avatar' => $uAvatar
        );

        return $this->loginMaan($mapData);
    }

    private function loginMaan($data)
    {
        if (!empty($data)) {
            $user = $this->getUserByAppotaId($data['user_id']);
            if (!empty($user)) {
                $paramsUser = [
                    'fullname' => $data['fullname'],
                    'mobile' => $data['phone_number'],
                    'avatar' => $data['avatar'],
                    'updated_at' => time(),
                ];
                $this->userService->update($user, $paramsUser);
            } else {
                $newUser = [
                    'appota_id' => $data['user_id'],
                    'role_id' => 10,
                    'google_id' => 10,
                    'facebook_id' => 10,
                    'password' => \Hash::make($data['email']),
                    'email' => $data['email'],
                    'fullname' => $data['fullname'],
                    'birthday' => '',
                    'phone' => $data['phone_number'],
                    'address' => '',
                    'avatar' => $data['avatar'] ?: \Hash::make($data['email']),
                    'gender' => 1,
                    'last_activity' => time(),
                    'access_token' => sha1($data['phone_number']),
                    'refresh_token' => sha1($data['phone_number']),
                    'remember_token' => sha1($data['phone_number']),
                    'expired_at' => time(),
                    'created_at' => time(),
                    'updated_at' => time(),
                ];
                if ($this->userService->store($newUser)) {
                    $this->createAccessToken($data);
                }
            }
            return $this->getUserByAppotaId($data['user_id']);
        } else {
            return false;
        }
    }

    private function createAccessToken($data)
    {
        $factory = JWTFactory::addClaims([
            'wallet_user_id' => $data['user_id'],
            'sub' => env('API_ID'),
            'iss' => config('app.name'),
            'iat' => time(),
            'exp' => JWTFactory::getTTL(),
            'nbf' => time(),
            'jti' => uniqid(),
        ]);
        $payload = $factory->make();
        $token = JWTAuth::encode($payload);

        $paramsUser = [
            'access_token' => $token
        ];
        $user = $this->getUserByAppotaId($data['user_id']);
        if (!$user) {
            return false;
        } else {
            $this->userService->update($user, $paramsUser);
        }
    }

    private function getUserByAppotaId($appotaId = null)
    {
        if (!$appotaId) {
            return false;
        } else {
            return $this->userService->get()->where('appota_id', $appotaId)->first();
        }
    }

}
