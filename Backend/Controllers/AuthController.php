<?php

namespace App\Backend\Controllers;

use App\Backend\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends MainController
{

    public function form()
    {
        return view('B::auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::guard('admin')->attempt([
            'name' => $request->name,
            'password' => $request->password,
            'is_active' => 1
        ], $request->remember)) {
            return redirect(route('admins.create'));
        }

        return redirect()
            ->back()
            ->withInput()
            ->with('authError', 'Не верный логин или пароль');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin.form'));
    }
}
