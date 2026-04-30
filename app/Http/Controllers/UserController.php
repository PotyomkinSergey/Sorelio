<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Requests\user\LoginUserRequest;
use App\Http\Requests\user\StoreUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        $user = User::create([
            ...$request->validated(),
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);

        return redirect('/tasks');
    }

    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/tasks');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
