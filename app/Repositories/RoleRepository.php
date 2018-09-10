<?php
/**
 * Created by IntelliJ IDEA.
 * User: DELL M4800
 * Date: 9/10/2018
 * Time: 10:14 PM
 */

namespace App\Repositories;

use App\Common\Repositories\Traits\EloquentRepository;
use App\Entities\Models\Role;

class RoleRepository
{
    use EloquentRepository;

    protected $_model;

    public function __construct(Role $role)
    {
        $this->_model = $role;
    }
}
