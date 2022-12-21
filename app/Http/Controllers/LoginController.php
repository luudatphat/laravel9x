<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Repository\UserRepository;
use App\Services\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(LoginRequest $request, LoginService $loginService)
    {
        if ($loginService->login($request->email, $request->password, $request->type)) {
            return to_route('home');
        }
        return back()->withErrors('Check email or password');
    }

    public function logout()
    {
        if (Auth::user()) {
            Auth::logout();
        }

        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        return redirect('/');
    }

    public function register()
    {
        return view('register');
    }

    public function createRegister(LoginRequest $request, LoginService $loginService)
    {
        $register =  $loginService->register($request->email, $request->password, $request->type);
        if ($register['status']) {
            return to_route('home');
        }
        return back()->withErrors($register['message']);
    }
}
