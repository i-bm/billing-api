<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    use ApiResponses;

    public function store(RegisterRequest $request): JsonResponse
    {

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // $user->assignRole(RoleNames::Standard);

        // UserRegistrationSuccessful::dispatch($user);
        // event(new UserRegistrationSuccessful($user));
        return $this->success('User created successfully', new UserResource($user), null, JsonResponse::HTTP_CREATED);
    }
}
