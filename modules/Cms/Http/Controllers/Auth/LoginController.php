<?php
/**
 * Created by PhpStorm.
 * User: DELL M4800
 * Date: 9/12/2018
 * Time: 4:43 PM
 */

namespace Modules\Cms\Http\Controllers\Auth;

use Modules\Cms\Http\Requests\Auth\LoginRequest;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Entities\Services\UserService;
use App\Http\Controllers\Controller;
use App\Common\Untils\Permission;
use App\Common\Gamota\RequestApi;
use App\Common\Untils\Regular;
use App\Entities\Models\User;
use App\Common\Libs\Google;
use Illuminate\Http\Request;


class LoginController extends \Modules\Cms\Http\Controllers\AbstractController
{
//    use ThrottlesLogins;

    protected $userService;
    
    public function __construct(UserService $userService, \Modules\Cms\Repositories\Contracts\UserRepository $user)
    {
        $this->middleware(Regular::PREFIX_GUEST, ['except' => 'logout']);
        $this->userService = $userService;
//        parent::__construct($user);
//        dd($this->repository);
    }

    public function index()
    {
        return view('cms::pages.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $endPoint = config('api.base_url_dev') . config('api.end_point_login');
        $apiParams = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $apiParams['sign'] = RequestApi::createSignature($apiParams);
        $res = RequestApi::create($endPoint, $apiParams, 'POST');
        $data = json_decode($res, true);
        if ($data['error_code'] == 0) {
            $user = $this->userService->get()->where('appota_id', $data['data']['info']['user_id'])->first();
            auth()->guard(Regular::PREFIX_CMS)->loginUsingId($user->id, true);
            return redirect()->intended('cms/dash');
        } else {
            self::delSession();
            return redirect()->route('cms.g.login')
                ->with(['error' => 'Your username or password is invalid!']);
        }
    }

    public function redirectToGoogle()
    {
        $config = base_path() . '/config/google-oauth.json';
        $client = new Google($config);

        if (session()->has("access_token")) {
            $client->setAccessToken(session()->get("access_token"));
            $oauthInfo = $client->Oauth2();
            session()->remove("access_token");
            $userInfo = User::where(['email' => $oauthInfo->email])->first();
            if ($userInfo) {
                $userInfo->fullname = $oauthInfo->name;
                $userInfo->save();
                $saveInfo = Code::toObject([
                    'fullname' => $userInfo->fullname,
                    'email' => $userInfo->email,
                    'role' => $userInfo->Roles->name,
                    'status' => $userInfo->status,
                ]);
                session()->set("users_info", $saveInfo);
                return redirect('cms.dash');
            }

            return redirect('cms/login')->with(['error' => 'Your account is not exist!']);
        }
        return redirect()->route('cms.handle.google');
    }

    public function handleGoogleCallback()
    {
        $config = base_path() . '/config/google-oauth.json';
        $host = env('APP_URL');
        $redirectUri = url('/cms/auth/google/callback');
        $client = new Google($config, $redirectUri);
        if (empty(request('code'))) {
            $auth_url = $client->createAuthUrl();
            return redirect($auth_url);
        }
        $client->authenticate(request('code'));
        $client->setAccessToken($client->getAccessToken());
        $oauthInfo = $client->Oauth2();
        $user = User::where(['email' => $oauthInfo->email])->first();
        // not exists
        if (empty($user)) {
            self::delSession();
            return redirect()->route('cms.g.login')->with(['error' => 'You are not exists!']);
            // not exists user in system => create new user and login
            // $this->loginCreateUser($oauthInfo);
        } else {
            $emailArr = explode('@', $user->email);
            if ($emailArr[1] != 'appota.com') {
                self::delSession();
                return redirect()->route('cms.g.login')->with(['error' => 'You must login in system with email @appota.com!']);
            }

            if ($user->role_id == Permission::PERM_ADMIN || $user->role_id == Permission::PERM_EDITOR) {
                // logged
                \Auth::guard()->loginUsingId($user->id, true);
                return redirect()->route('cms.dash');
            }
            // not permission
            self::delSession();
            return redirect()->route('cms.g.login')->with(['error' => 'You can\'t login because not havent\'t permission!']);

        }
    }

    private static function delSession()
    {
        auth()->guard()->logout();
        session()->flush();
    }

    public function logout(Request $request)
    {
        self::delSession();
        return redirect('cms/login');
    }

}
