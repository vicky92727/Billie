<?php

namespace App\Repository\Eloquent;

use App\Models\Company;
use App\Repository\CompanyRepositoryInterface;

class CompanyRepository extends BaseRepository implements CompanyRepositoryInterface
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
    public function __construct(Company $model)
    {
        $this->model = $model;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $userData = $request->only(['title', 'email', 'phone', 'address', 'type', 'debtor_limit']);
        $postData['title'] = ucwords($userData['title']);
        $postData['email'] = $userData['email'];
        $postData['phone'] = $userData['phone'];
        $postData['address'] = $userData['address'];
        $postData['type'] = $userData['type'];
        $postData['debtor_limit'] = $userData['debtor_limit'];
        $company = $this->create($postData);
        return $company;
    }
}