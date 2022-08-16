<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginFormRequest;
use App\Http\Resources\Auth\UserLoginResource;
use App\Models\User;
use App\Services\User\UserAuthService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use ResponseTrait;

    private $userAuthService;

    public function __construct(UserAuthService $userAuthService)
    {
        $this->userAuthService = $userAuthService;
    }

    public function login(LoginFormRequest $request): JsonResponse
    {
        $user = $this->userAuthService->login($request->validated());

        return $this->responseUser('success', new UserLoginResource($user), $user->createToken('User-Token')->plainTextToken);
    }
}
