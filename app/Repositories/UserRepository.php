<?php

namespace App\Repositories;

use App\Common\Repositories\Traits\EloquentRepository;
use App\Entities\Models\User;

class UserRepository
{
    use EloquentRepository;

    protected $_model;

    public function __construct(User $user)
    {
        $this->_model = $user;
    }

    public function findWhere(string $attribute, $value)
    {
        $this->_model->where($attribute, $value)->first();
    }
}
