<?php

namespace App\Repositories;

use App\Common\Repositories\Traits\EloquentRepository;
use App\Entities\Models\User;

class UserRepository extends AbstractRepository
{
    protected $_model;

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function findWhere(string $attribute, $value)
    {
        $this->_model->where($attribute, $value)->first();
    }
}
