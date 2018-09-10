<?php
namespace App\Repositories;

use App\Common\Repositories\Traits\EloquentRepository;
use App\Entities\Models\App;

class AppRepository
{
    use EloquentRepository;

    protected $_model;

    public function __construct(App $app)
    {
        $this->_model = $app;
    }
}
