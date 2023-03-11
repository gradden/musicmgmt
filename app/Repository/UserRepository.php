<?php

namespace App\Repository;

use App\Models\User;

class UserRepository
{
    public function create(array $data)
    {
        return User::firstOrCreate(
            [
                'email' => $data['email']
            ],
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password']
            ]
        );
    }

    public function isExists(string $email)
    {
        return User::where('email', '=', $email)->exists();
    }
}
