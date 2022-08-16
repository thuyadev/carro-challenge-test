<?php

namespace App\Repositories\User;

use App\Models\User;

class UserAuthRepository implements UserAuthRepositoryInterface
{
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->firstOrFail();
    }
}