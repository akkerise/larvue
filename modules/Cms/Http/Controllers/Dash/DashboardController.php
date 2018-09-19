<?php
/**
 * Created by PhpStorm.
 * User: DELL M4800
 * Date: 9/12/2018
 * Time: 5:41 PM
 */

namespace Modules\Cms\Http\Controllers\Dash;

use App\Common\Untils\Regular;
use Modules\Cms\Http\Controllers\AbstractController;

class DashboardController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
//        dd(auth()->guard(Regular::PREFIX_CMS)->user());
        $this->middleware(Regular::PREFIX_CMS);
    }

    public function index()
    {
        return view('cms::pages.dash.dash');
    }
}
