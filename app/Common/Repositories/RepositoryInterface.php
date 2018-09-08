<?php

namespace App\Modules\Cms\Repositories;


use Illuminate\Database\Eloquent\Model;
/**
 * Created by IntelliJ IDEA.
 * User: akke
 * Date: 5/25/18
 * Time: 1:21 AM
 */
interface RepositoryInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function all();

    /**
     * @param int $perPage
     * @param array $columns
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*'));

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update(Model $model, array $attributes);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Find by attribute
     * @param $attribute
     * @return mixed
     */
    public function by($attribute, $value, $columns = array('*'));
}
