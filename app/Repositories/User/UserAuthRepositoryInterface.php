<?php

namespace App\Repositories\User;

use App\Models\User;

interface UserAuthRepositoryInterface
{
    public function findByEmail(string $email): ?User;
}