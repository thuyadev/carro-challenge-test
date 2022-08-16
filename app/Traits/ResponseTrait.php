<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ResponseTrait
{
    public function responseSuccess($message = 'successful', $data = []): JsonResponse
    {
        return response()->json([
            'code'  => Response::HTTP_OK,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function responseMsgOnly($msg = 'success'): JsonResponse
    {
        return response()->json([
            'code'  => Response::HTTP_OK,
            'message' => $msg
        ]);
    }

    public function responseUser($msg = 'success', $user, $token): JsonResponse
    {
        return response()->json([
            'code'  => Response::HTTP_OK,
            'message' => $msg,
            'user' => $user,
            'token' => $token
        ]);
    }
}