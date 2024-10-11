<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use ApiResponses;

    public function store(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials)) {
            return $this->error('Invalid credentials', null, 401);
        }

        $user = Auth::user();
        // $token = $user->createToken('authToken')->plainTextToken;
        // $request->session()->regenerate();
        return $this->success('Login was successful', new UserResource($user), null, JsonResponse::HTTP_OK);
    }
}
