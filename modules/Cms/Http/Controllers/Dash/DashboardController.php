<?php
/**
 * Created by PhpStorm.
 * User: DELL M4800
 * Date: 9/12/2018
 * Time: 5:41 PM
 */

namespace Modules\Cms\Http\Controllers\Dash;

use Modules\Cms\Http\Controllers\AbstractController;

class DashboardController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('cms');
    }

    public function index()
    {
        return view('cms::pages.dash.dash');
    }
}
