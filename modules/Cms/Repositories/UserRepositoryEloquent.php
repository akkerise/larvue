<?php

namespace Modules\Cms\Repositories;

use App\Eloquent\User;
use Modules\Cms\Repositories\Contracts\UserRepository;

class UserRepositoryEloquent extends AbstractRepositoryEloquent implements UserRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function datatables($columns = ['*'],  $with = [])
    {
    	return $this->model->with($with)->where('id','<>','1')->orderBy('id', 'desc')->get($columns);
    }
}
