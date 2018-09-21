<?php

namespace Modules\Cms\Http\Controllers;

use App\Common\Untils\Regular;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cms\Repositories\Contracts\UserRepository;

class CmsController extends AbstractController
{
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct($userRepository);
        $this->middleware(Regular::PREFIX_CMS);
    }

    public function index()
    {
        if (auth()->guest()) {
            return redirect()->route('cms.g.login');
        } else {
            return redirect()->route('cms.dash');
        }
    }

}
