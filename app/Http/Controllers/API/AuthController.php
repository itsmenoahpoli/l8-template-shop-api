<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use Auth;

class AuthController extends Controller
{
    public function login(Request $request) : JsonResponse
    {
        try
        {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials))
            {
                $user = Auth::user();
                $userAccessToken = $user->createToken(
                    time().
                    '-'.
                    $user->id
                )->plainTextToken;

                return response()->json([
                    'user' => $user,
                    'accessToken' => $userAccessToken
                ], 200);
            }

            return response()->json(
                'Unauthorized',
                401
            );

        } catch (Exception $e)
        {
            return response()->json(
                $e->getMessage(),
                500
            );
        }
    }

    public function logout(Request $request) : JsonResponse
    {

    }
}
