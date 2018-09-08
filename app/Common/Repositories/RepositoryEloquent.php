<?php
/**
 * Created by IntelliJ IDEA.
 * User: akke
 * Date: 5/25/18
 * Time: 1:23 AM
 */

namespace App\Modules\Cms\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class RepositoryEloquent implements RepositoryInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $_model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     * @return string
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get All
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->_model->all();
    }

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*'))
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->_model->find($id);
        return $result;
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
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
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update(Model $model, array $input)
    {
        if (false === $model->update($input)) {
            throw new Exception('update models fails.');
        }
        $result = $model;
        Log::debug('#', ['result' => (bool)$result]);
        return $result;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();
            return true;
        }

        return false;
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function by($attribute, $value, $columns = array('*'))
    {
        return $this->_model->where($attribute, '=', $value)->first($columns);
    }
}
