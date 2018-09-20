<?php

namespace App\Common\Repositories\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Log;

/**
 * @package App\Repositories\Traits
 */
trait EloquentRepository
{
    /**
     * @var Model|Builder
     */
    protected $_model;

    /**
     * @return Model|Builder
     */
    protected function getModel()
    {
        return $this->_model;
    }

    protected function on($connection = null)
    {
        return $this->_model->on($connection);
    }

    public function newQuery()
    {
        return clone $this->_model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function get()
    {
        $result = $this->getModel()->get();
        logger()->debug('#', ['result' => $result->count()]);
        return $result;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        $result = $this->getModel()->get();
        logger()->debug('#', ['result' => $result->count()]);
        return $result;
    }

    /**
     * @param int $id
     * @return null|Model
     */
    public function find(int $id, $columns = ['*'])
    {
        $result = $this->getModel()->find($id, $columns);
        logger()->debug('#', ['result' => (bool)$result, 'id' => $id]);
        return $result;
    }

    /**
     * @param int $id
     * @return Model
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrFail(int $id, $columns = ['*'])
    {
        $result = $this->getModel()->findOrFail($id, $columns);
        logger()->debug('#', ['result' => (bool)$result, 'id' => $id]);
        return $result;
    }

    /**
     * @param array $input
     * @return Model
     * @throws Exception
     */
    public function store(array $input)
    {
        $model = $this->getModel()->fill($input);
        if (!$model->save()) {
            throw new Exception('create model fails.');
        }
        $result = $model;
        logger()->debug('#', ['result' => (bool)$result]);
        return $result;
    }

    /**
     * @param array $input
     * @return Model
     * @throws Exception
     */
    public function create(array $input)
    {
        $model = $this->getModel()->fill($input);
        if (!$model->save()) {
            throw new Exception('create model fails.');
        }
        $result = $model;
        logger()->debug('#', ['result' => (bool)$result]);
        return $result;
    }

    /**
     * @param Model $model
     * @param array $input
     * @return Model
     * @throws Exception
     */
    public function update(Model $model, array $input)
    {
        if (false === $model->update($input)) {
            throw new Exception('update models fails.');
        }
        $result = $model;
        logger()->debug('#', ['result' => (bool)$result]);
        return $result;
    }

    /**
     * @param Model $model
     * @return bool
     * @throws Exception
     */
    public function delete(Model $model)
    {
        if (!$model->delete()) {
            throw new Exception('delete models fails.');
        }
        $result = true;
        logger()->debug('#', compact('result'));
        return $result;
    }

    /**
     * @param array $conditions
     * @return int
     */
    public function getCount(array $conditions = [])
    {
        $query = $this->getPageQuery($conditions);
        $result = $query->count();
        logger()->debug('#', compact('result'));
        return $result;
    }

    /**
     * public function scopeSort($query, $key, $direction)
     * {
     *     switch ($key) {
     *         case 'id';
     *             $query->orderBy($key, $direction);
     *             break;
     *         default;
     *             $query->orderBy($key, $direction)->orderBy('id', $direction);
     *             break;
     *     }
     * }
     *
     * @param int $page
     * @param int $per_page
     * @param string $sort
     * @param string $order
     * @param array $conditions
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPageItem(int $page, int $per_page, string $sort = null, string $order = null, array $conditions = [])
    {
        $sort = $sort ?? 'id';
        $order = $order ?? 'desc';

        $query = $this->getPageQuery($conditions);
        method_exists($this->getModel(), 'scopeSort') ? $query->sort($sort, $order) : $query->orderBy($sort, $order);
        $result = $query
            ->skip(($page - 1) * $per_page)
            ->take($per_page)
            ->get();
        logger()->debug('#', ['result' => $result->count()]);
        return $result;
    }

    /**
     * @param array $conditions
     * @return Builder
     */
    protected function getPageQuery(array $conditions = [])
    {
        return $this->getModel()->newQuery();
    }

    public function destroy($ids = [])
    {
        return $this->_model->destroy($ids);
    }

    public function take($limit, $columns = ['*'])
    {
        return $this->_model->orderBy('id', 'DESC')->take($limit)->get($columns);
    }

    public function paginate($limit = null, $columns = ['*'])
    {
        return $this->_model->orderBy('id', 'DESC')->paginate($limit, $columns);
    }

    public function datatables($columns = ['*'], $with = [])
    {
        return $this->_model->with($with)->orderBy('id', 'desc')->get($columns);
    }
}
