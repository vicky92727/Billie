<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $userData = $request->only(['name', 'email', 'password']);
        $postData['name'] = ucwords($userData['name']);
        $postData['email'] = $userData['email'];
        $postData['password'] = bcrypt($userData['password']);
        $user = $this->create($postData);
        return $user;
    }
}