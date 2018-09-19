<?php
/**
 * Created by IntelliJ IDEA.
 * User: DELL M4800
 * Date: 9/11/2018
 * Time: 12:45 AM
 */

namespace App\Entities\Services;

use App\Repositories\UserRepository;
use App\Entities\Models\User;

class UserService {

    protected $user;

    public function __construct (UserRepository $user){
        $this->user = $user;
    }

    public function get(){
        return $this->user->get();
    }

    public function store(array $input){
        try {
            \DB::beginTransaction();
            $result = $this->user->store($input);
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
            $result = $this->user->update($user, $input);
            \DB::commit();
        } catch (\Exception $e) {
            logger()->error(sprintf('update user fails. id: %d, data: %s, exception: %s', $user->id, json_encode($input), $e->getMessage()));
            \DB::rollBack();
            $result = false;
        }
        logger()->debug('#', ['result' => (bool)$result, 'id' => $user->id]);
        return $result;
    }

    public function delete(User $user){
        try {
            \DB::beginTransaction();
            $result = $this->user->delete($user);
            \DB::commit();
            $result = true;
        } catch (\Exception $e) {
            dd($e);
            logger()->error(sprintf('delete user fails. id: %d, data: %s, exception: %s', $user->id, json_encode($user), $e->getMessage()));
            \DB::rollBack();
            $result = false;
        }
        logger()->debug('#', ['result' => (bool)$result]);
        return $result;
    }

    public function findOrFail($id){
        return $this->user->findOrFail($id);
    }

    public function findId($id){
        return $this->user->find($id);
    }

    public function findWhere(string $attribute, $value){
        return $this->user->findWhere($attribute, $value);
    }

}
