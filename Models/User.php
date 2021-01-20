<?php

namespace App\Models;


use App\Backend\Helpers\TableNameTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
    use TableNameTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//REPOSITORY
//*************************************************************
    public static function createUser($request)
    {
        $data = $request->input();

        $user = new self;

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->email_verified_token = Hash::make('bla-bla'.$data['email'].time());
        $user->email_verified_at = Carbon::now();
        $user->password = Hash::make($data['password']);
        $user->is_hidden = 1;

        if ($user->save()) {
            return $user;
        }

        return false;
    }

    public static function getUserByEmailVerifiedToken($token)
    {
        return self::where('email_verified_token', $token)
            ->where('is_hidden', 1)
            ->first();
    }

    public static function UserConfirmation($user)
    {
        $user->email_verified_token = null;
        $user->is_hidden = 0;

        if ($user->save()) {
            return $user;
        }

        return false;
    }

    public static function getUserByEmail($email) {
        return self::where('email', $email)
            ->where('is_hidden', 0)
            ->where('email_verified_token', null)
            ->first();
    }

    public static function getUserByResetPasswordToken($id, $token) {
        return self::where('id', $id)
            ->where('is_hidden', 0)
            ->where('email_verified_token', null)
            ->where('password_reset_token', $token)
            ->first();
    }

    public static function setResetPasswordToken($user) {
        $user->password_reset_token = Hash::make('bla-bla-bla'.$user->id.time());;

        if ($user->save()) {
            return $user;
        }

        return false;
    }

    public static function setNewPassword($user, $request)
    {
        $user->password = Hash::make($request->password);
        $user->password_reset_token = null;

        if ($user->save()) {
            return $user;
        }

        return false;
    }

    public static function getUserByLikeLogin($login)
    {
        return self::where('name', 'LIKE', $login.'%')
            ->first();
    }
}
