<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function findUserByUid(String $uid)
    {
        return User::query()
            ->where('uid', '=', $uid)
            ->first();
    }

    public function createUser(array $data)
    {
        return User::query()->create($data);
    }

    public function findByUsername(String $username)
    {
        return User::query()
            ->where('email', '=', $username)
            ->orWhere('phone_number', '=', $username)
            ->first();
    }
}
