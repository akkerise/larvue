<?php
/**
 * Created by PhpStorm.
 * User: DELL M4800
 * Date: 9/20/2018
 * Time: 10:21 AM
 */

namespace Modules\Cms\Http\Controllers\App;

use Modules\Cms\Http\Controllers\AbstractController;
use App\Common\Gamota\RequestApi;
use App\Common\Untils\Permission;
use App\Common\Untils\Regular;

class AppController extends AbstractController
{
    protected $userService;

    public function __construct(UserService $userService, \Modules\Cms\Repositories\Contracts\UserRepository $user)
    {
        $this->middleware(Regular::PREFIX_CMS);
        $this->userService = $userService;
        parent::__construct();
        //        dd($this->repository);
    }

    public function index()
    {
        return view('cms::pages.auth.login');
    }


}