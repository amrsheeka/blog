<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect()->route('posts.index');
        }
        return back()->withErrors(['email' => 'Invalid credentials']);
    }
    public function register()
    {
        return view('auth.register');
    }
    public function store(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        Auth::login($user);
        return redirect()->route('posts.index');
    }
    public function logout()
    {
        Auth::logout();

        return redirect()->route('posts.index');
    }
}
