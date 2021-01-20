<?php

namespace App\Frontend\Controllers;

use App\Frontend\Requests\Auth\ForgottenPasswordRequest;
use App\Frontend\Requests\Auth\LoginRequest;
use App\Frontend\Requests\Auth\NewPasswordRequest;
use App\Frontend\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends MainController
{
    /*use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;*/

    private $mailFrom = 'albatrosus8@gmail.com';
    //private $mailFrom = env('APP_URL');

    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth')
            ->only('logout');

        $this->middleware('guest')
            ->except('logout');
    }

    public function loginForm()
    {
        return view('F::auth.login-form');
    }

    public function registerForm()
    {
        return view('F::auth.register-form');
    }

    public function checkLoginAjax(Request $request)
    {
        $status = 0;

        if (User::getUserByLikeLogin($request->login)) {
            $status = 1;
        }

        return '{"status":"'.$status.'"}';
    }

    public function forgottenPasswordForm()
    {
        return view('F::auth.forgotten-password-form');
    }

    public function newPasswordForm(Request $request)
    {
        $user = User::getUserByResetPasswordToken($request->id, $request->token);

        if (!$user) {
            abort(404);
        }

        return view('F::auth.new-password-form');
    }

    public function forgottenPassword(ForgottenPasswordRequest $request)
    {
        $user = User::getUserByEmail($request->email);

        if (!$user) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Пользователя с таким E-mail не существует');
        } else {

            $confirmUser = User::setResetPasswordToken($user);

            if ($confirmUser) {
                $data = [
                    'id' => $confirmUser->id,
                    'name' => $confirmUser->name,
                    'token' => $confirmUser->password_reset_token,
                    'appUrl' => env('APP_URL')
                ];

                Mail::send('F::email.auth.forgotten-password', $data, function($message) use ($request) {
                    $message->to($request->email, $request->name)->subject('Восстановление пароля');
                    $message->from($this->mailFrom, env('APP_NAME'));
                });

                return redirect(route('home'))
                    ->with('success', 'Проверьте почту');
            } else {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Ошибка');
            }
        }
    }

    public function verified(Request $request)
    {
        $user = User::getUserByEmailVerifiedToken($request->token);

        if ($user) {
            if (User::UserConfirmation($user)) {
                return redirect(route('login'))
                    ->with('success', 'Регистрация успешно подтверждена. Можете войти.');
            } else {
                //
            }
        } else {
            abort(404);
        }
    }

    public function newPassword(NewPasswordRequest $request)
    {
        $user = User::getUserByResetPasswordToken($request->id, $request->token);

        if ($user) {
            if (User::setNewPassword($user, $request)) {
                return redirect(route('login'))
                    ->with('success', 'Пароль успешно изменен.');
            } else {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Ошибка смены пароля');
            }
        } else {
            abort(404);
        }
    }

    public function register(RegisterRequest $request)
    {
        $user = User::createUser($request);

        if ($user) {

            $data = [
                'name' => $user->name,
                'token' => $user->email_verified_token,
                'appUrl' => env('APP_URL')
            ];

            Mail::send('F::email.auth.register', $data, function($message) use ($request) {
                $message->to($request->email, $request->name)->subject('Регистрация на сайте');
                $message->from($this->mailFrom, env('APP_NAME'));
            });

            return redirect(route('home'))
                ->with('success', 'На указанный Вами E-mail отправлено письмо о подтверждении регистрации.');
        }

        return redirect()->back()->withInput()->with('error', 'Ошибка регистрации');
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'is_hidden' => 0,
            'email_verified_token' => null
        ], $request->remember)) {
            return redirect(route('home'));
        }

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Не верный логин или пароль');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('home'));
    }
}
