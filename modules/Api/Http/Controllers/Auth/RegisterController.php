<?php
/**
 * Created by IntelliJ IDEA.
 * User: DELL M4800
 * Date: 9/11/2018
 * Time: 12:14 AM
 */

namespace Modules\Api\Http\Controllers\Auth;

use Illuminate\Support\Facades\Request;
use Modules\Api\Http\Controllers\ApiController;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends ApiController
{
    public function __construct()
    {
    }

    public function register(Request $request){

    }
}
