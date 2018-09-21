<?php

namespace Modules\Cms\Http\Controllers\Auth;

use Modules\Cms\Http\Controllers\AbstractController;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Repositories\UserRepository;
use App\Common\Untils\Permission;
use App\Common\Gamota\RequestApi;
use App\Common\Untils\Regular;

class FacebookController extends AbstractController
{
    use ThrottlesLogins;

    public function __construct(UserRepository $user)
    {
        parent::__construct($user);
        $this->middleware(Regular::PREFIX_GUEST);
    }

    public function redirect($provider)
    {
        return \Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $user = \Socialite::driver($provider)->user();
        $auth = $this->findOrCreateUser($user);
        auth()->guard(Regular::PREFIX_CMS)->loginUsingId($auth->id, true);
        return redirect()->route('cms.dash');
    }

    public function findOrCreateUser($user)
    {
        $auth = $this->repository->all()->where('email', $user->email)->first();
        if ($auth) {
            return $auth;
        }
        return $this->repository->create([
            'appota_id' => (string)$user->id,
            'role_id' => rand(4, 10),
            'google_id' => null,
            'facebook_id' => config('services.facebook.client_id'),
            'email' => $user->email,
            'password' => \Hash::make(config('services.facebook.client_secret')),
            'fullname' => $user->name,
            'avatar' => $user->avatar,
            'gender' => rand(1, 4),
            'phone' => null,
            'address' => null,
            'access_token' => $user->token,
            'refresh_token' => time() + $user->refreshToken,
            'last_activity' => __FUNCTION__,
            'expired_at' => $user->expiresIn
        ]);
    }
}