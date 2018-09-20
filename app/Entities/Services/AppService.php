<?php
/**
 * Created by PhpStorm.
 * User: DELL M4800
 * Date: 9/20/2018
 * Time: 3:06 PM
 */

namespace App\Entities\Services;

use App\Entities\Models\App;
use App\Repositories\AppRepository;

class AppService
{
    protected $app;

    public function __construct(AppRepository $app)
    {
        $this->app = $app;
    }

    public function get()
    {
        return $this->app->get();
    }

    public function store(array $input)
    {
        try {
            \DB::beginTransaction();
            $result = $this->app->store($input);
            \DB::commit();
        } catch (\Exception $e) {
            dd($e);
            logger()->error(sprintf('create user fails. data: %s, exception: %s', json_encode($input), $e->getMessage()));
            \DB::rollBack();
            $result = false;
        }
        logger()->debug('#', ['result' => (bool)$result]);
        return $result;
    }

    public function update(User $user, array $input)
    {
        try {
            \DB::beginTransaction();
            $result = $this->app->update($user, $input);
            \DB::commit();
        } catch (\Exception $e) {
            logger()->error(sprintf('update user fails. id: %d, data: %s, exception: %s', $user->id, json_encode($input), $e->getMessage()));
            \DB::rollBack();
            $result = false;
        }
        logger()->debug('#', ['result' => (bool)$result, 'id' => $user->id]);
        return $result;
    }

    public function delete(App $app)
    {
        try {
            \DB::beginTransaction();
            $result = $this->app->delete($app);
            \DB::commit();
            $result = true;
        } catch (\Exception $e) {
            dd($e);
            logger()->error(sprintf('delete user fails. id: %d, data: %s, exception: %s', $app->id, json_encode($app), $e->getMessage()));
            \DB::rollBack();
            $result = false;
        }
        logger()->debug('#', ['result' => (bool)$result]);
        return $result;
    }

    public function findOrFail($id)
    {
        return $this->app->findOrFail($id);
    }

    public function findId($id)
    {
        return $this->app->find($id);
    }

    public function findWhere(string $attribute, $value)
    {
        return $this->app->findWhere($attribute, $value);
    }
}