<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\AbstractController;
use Illuminate\Database\Eloquent\Model;
use App\Services\Contracts\AbstractService;

abstract class BackendController extends AbstractController
{
    protected $viewPrefix = 'backend.';

    protected $guard = 'backend';

    public function getData($items = null)
    {
        //$this->before('index');
        return \Datatables::of($items ? $items : $this->repository->datatables($this->dataSelect))
            ->addColumn('actions', function ($item) {
                $actions = [];
                if ($this->before('show', $item, false)) {
                    $actions['show'] = [
                        'uri' => route($this->viewPrefix.$this->repositoryName.'.show', $item->id),
                        'label' => $this->trans('show'),
                    ];
                }
                if ($this->before('edit',$item, false)) {
                    $actions['edit'] = [
                        'uri' => route($this->viewPrefix.$this->repositoryName.'.edit', $item->id),
                        'label' => $this->trans('edit'),
                    ];
                }
                if ($this->before('delete',$item, false)) {
                    $actions['delete'] = [
                        'uri' => route($this->viewPrefix.$this->repositoryName.'.destroy', $item->id),
                        'label' => $this->trans('delete'),
                    ];
                }

                return $actions;
            })->make(true);
    }

    public function index()
    {
        $this->view = $this->repositoryName.'.index';
        $this->compacts['heading'] = $this->trans('object.index');
        $this->compacts['resource'] = $this->repositoryName;
    }

    public function create()
    {
        $this->view = $this->repositoryName.'.create';
        $this->compacts['heading'] = $this->trans('object.create');
        $this->compacts['resource'] = $this->repositoryName;
    }

    public function show($id)
    {
        $this->view = $this->repositoryName.'.show';
        $this->compacts['item'] = $this->repository->findOrFail($id);
        $this->compacts['heading'] = $this->trans('object.show');
        $this->compacts['resource'] = $this->repositoryName;
    }

    public function edit($id)
    {
        $this->view = $this->repositoryName.'.edit';
        $this->compacts['item'] = $this->repository->findOrFail($id);
        $this->compacts['heading'] = $this->trans('object.edit');
        $this->compacts['resource'] = $this->repositoryName;
    }

    public function storeData(array $data, AbstractService $service, $redirect = null, callable $callback = null)
    {
        //$this->before(__FUNCTION__);
        try {
            $item = $service->store($data);
            $this->activityLog('create');
            $this->e['message'] = $this->trans('object_created_successfully');
        } catch (\Exception $e) {
            dd($e);
            $this->e['code'] = 100;
            $this->e['message'] = $this->trans('object_created_unsuccessfully');
        }
        $redirect = $redirect ? $redirect : route($this->viewPrefix.$this->repositoryName.'.index');
        if (is_callable($callback)) {
            call_user_func_array($callback, [$item]);
        }
        return redirect($redirect)->with('flash_message',json_encode($this->e, true));
    }

    public function updateData(array $data, AbstractService $service, Model $entity, $redirect = null, callable $callback = null)
    {
        //$this->before(__FUNCTION__, $entity);
        try {
            $newEntity = $service->update($entity, $data);
            $this->activityLog('update');
            $this->e['message'] = $this->trans('object_updated_successfully');
        } catch (\Exception $e) {
            dd($e);
            $this->e['code'] = 100;
            $this->e['message'] = $this->trans('object_updated_unsuccessfully');
        }
        $redirect = $redirect ? $redirect : route($this->viewPrefix.$this->repositoryName.'.index');
        if (is_callable($callback)) {
            call_user_func_array($callback, [$newEntity]);
        }
        return redirect($redirect)->with('flash_message',json_encode($this->e, true));
    }

    public function deleteData(AbstractService $service, Model $entity, $redirect = null)
    {
        //$this->before(__FUNCTION__, $entity);
        try {
            $service->delete($entity);
            $this->activityLog('delete');
            $this->e['message'] = $this->trans('object_deleted_successfully');
        } catch (\Exception $e) {
            $this->e['code'] = 100;
            $this->e['message'] = $this->trans('object_deleted_unsuccessfully');
        }
        $redirect = $redirect ? $redirect : route($this->viewPrefix.$this->repositoryName.'.index');
        if (\Request::ajax() || \Request::wantsJson()) {
            return session()->flash('flash_message', json_encode($this->e, true));
        }
        return redirect($redirect)->with('flash_message',json_encode($this->e, true));
    }

    public function destroyData(AbstractService $service, $ids = [], $redirect = null)
    {
        $this->before(__FUNCTION__);
        try {
            $service->destroy($ids);
            $this->activityLog('destroy');
            $this->e['message'] = $this->trans('object_deleted_successfully');
        } catch (\Exception $e) {
            $this->e['code'] = 100;
            $this->e['message'] = $this->trans('object_deleted_unsuccessfully');
        }
        $redirect = $redirect ? $redirect : route($this->viewPrefix.$this->repositoryName.'.index');
        if (\Request::ajax() || \Request::wantsJson()) {
            return session()->flash('flash_message', json_encode($this->e, true));
        }
        return redirect($redirect)->with('flash_message',json_encode($this->e, true));
    }
}
