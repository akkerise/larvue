<?php
namespace App\Repositories;

use App\Common\Repositories\Traits\EloquentRepository;
use App\Entities\Models\Notification;

class NotificationRepository
{
    use EloquentRepository;

    protected $_model;

    public function __construct(Notification $notification)
    {
        $this->_model = $notification;
    }
}
