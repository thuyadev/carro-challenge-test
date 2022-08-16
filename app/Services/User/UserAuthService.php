<?php

namespace App\Services\User;

use App\Exceptions\CustomException;
use App\Models\User;
use App\Repositories\User\UserAuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserAuthService
{
    private UserAuthRepositoryInterface $userAuthRepository;

    public function __construct(UserAuthRepositoryInterface $userAuthRepository)
    {
        $this->userAuthRepository = $userAuthRepository;
    }

    public function login($request): User
    {
        $user = $this->userAuthRepository->findByEmail($request['email']);

        if (!Hash::check($request['password'], $user['password']))
        {

            throw new CustomException('Invalid credentials', 404);

        }

        return $user;
    }
}