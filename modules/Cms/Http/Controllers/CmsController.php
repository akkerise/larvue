<?php

namespace Modules\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class CmsController extends \App\Http\Controllers\Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return redirect()->route('cms.g.login');
    }

}
