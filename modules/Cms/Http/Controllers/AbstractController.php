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
    protected $repository;

    protected $repositoryName;

    protected $user;

    protected $compacts;

    protected $view;

    protected $dataSelect = ['*'];
    
    protected $e = array(
        'code' => 0,
        'message' => null,
    );
    
    public function __construct($repository = null)
    {
        if ($repository) {
            $this->repositorySetup($repository);
        }
        $this->user = \Auth::guard($this->getGuard())->user();
    }
    
    public function repositorySetup($repository = null)
    {
        $this->repository = $repository;
        $this->repositoryName = strtolower(class_basename($this->repository->getModel()));
    }
    
    public function viewRender($data = [], $view = null)
    {
        $view = $view ? $view : $this->view;
        $compacts = array_merge($data, $this->compacts);

        return view($this->viewPrefix.$view, $compacts);
    }
    
    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
    }
    
    public function response($success = false, $message = null, $data = [])
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data,
        ]);
    }
}