<?php

namespace App\Repository;

use App\Models\User;

class UserRepository
{
    protected $model;
    public function __construct()
    {
        $this->model = new User();
    }

    public function getShop(string $domain)
    {
        return $this->model->where('domain', $domain)->first();
    }

    public function createShop(string $domain, array $data)
    {
        return $this->model->where('domain', $domain)->create($data);
    }

    public function updateShop(string $domain, array $data)
    {
        return $this->model->where('domain', $domain)->update($data);
    }

    public function getUserByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function createUserByEmail(array $data)
    {
        return $this->model->create($data);
    }
}
