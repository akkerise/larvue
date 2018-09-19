<?php
/**
 * Created by PhpStorm.
 * User: DELL M4800
 * Date: 9/18/2018
 * Time: 6:16 PM
 */

namespace Modules\Api\Http\Controllers\User;

use Illuminate\Support\Facades\Request;
use Modules\Api\Http\Controllers\ApiController;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
//        $this->middleware('api-authenticate');
    }

    public function info(Request $request){
        $user = JWTAuth::toUser($request->token);
        return $this->respondData(0,'Success', ['user' => $user]);
    }
}