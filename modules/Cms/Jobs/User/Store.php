<?php

namespace App\Jobs\User;

use App\Jobs\Job;
use App\Traits\Jobs\UploadableTrait;
use App\Traits\Jobs\NotificationTrait;
use App\Repositories\Contracts\UserRepository;

class Store extends Job
{
    use UploadableTrait, NotificationTrait;

    protected $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(UserRepository $repository)
    {
        $path = strtolower(class_basename($repository->getModel()));
        $this->attributes['password'] = bcrypt($this->attributes['password']);
        if (isset($this->attributes['image'])) {
            $this->attributes['image'] = $this->uploadFile($this->attributes['image'], $path);
        }
        $user = $repository->create($this->attributes);
        $user->roles()->sync($this->attributes['role_id']);
        $this->notification($user, $user->id, "Hi {$user->name}, Welcome to System.",'fa-user-plus',route('backend.profile'));
    }
}
