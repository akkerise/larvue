<?php
/**
 * Created by PhpStorm.
 * User: DELL M4800
 * Date: 9/20/2018
 * Time: 3:14 PM
 */

namespace App\Repositories;

use App\Common\Repositories\Traits\EloquentRepository;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    use EloquentRepository;

    protected $_model;

    public function __construct(Model $model)
    {
        $this->_model = $model;
    }

    public function findWhere(string $attribute, $value)
    {
        $this->_model->where($attribute, $value)->first();
    }
}