<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    use ApiResponses;

    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

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

    public function processLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials)) {
            return throw ValidationException::withMessages([
                'email' => 'Incorrect email or password'
            ]);
        }

        $user = Auth::user();

        Auth::login($user);
        return redirect()->route('home');
    }

    public function logout(){

        Auth::logout();
        return redirect()->route('login');
    }


    public function showRegisterForm() : View {
        return view('pages.auth.register');
    }
}
