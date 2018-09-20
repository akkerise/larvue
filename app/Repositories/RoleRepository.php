<?php
/**
 * Created by IntelliJ IDEA.
 * User: DELL M4800
 * Date: 9/10/2018
 * Time: 10:14 PM
 */

namespace App\Repositories;

use App\Entities\Models\Role;

class RoleRepository extends AbstractRepository
{
    protected $_model;

    public function __construct(Role $role)
    {
        parent::__construct($role);
    }
}
