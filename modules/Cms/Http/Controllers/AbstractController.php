<?php
/**
 * Created by PhpStorm.
 * User: DELL M4800
 * Date: 9/12/2018
 * Time: 3:53 PM
 */

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;

abstract class AbstractController extends Controller
{
    public function __construct(){}

    public function response($success = false, $message = null, $data = [])
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ]);
    }
}