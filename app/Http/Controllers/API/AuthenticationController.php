<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use App\Http\Requests\User\RegisterRequest;

class AuthenticationController extends Controller
{
    use ApiResponses;

    public function processRegistration(RegisterRequest $request): JsonResponse
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
