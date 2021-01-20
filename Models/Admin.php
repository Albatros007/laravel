<?php

namespace App\Models;

use App\Backend\Helpers\SortTrait;
use App\Backend\Helpers\TableNameTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use Notifiable;
    use SortTrait;
    use TableNameTrait;

    protected $guard = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'role', 'is_active'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $roles = [
        1  => 'Пользователь',
        5  => 'Редактор',
        10 => 'Администратор',
    ];

    public static function getAllPgt($pNum)
    {
        self::sortData();

        return self::orderBy(self::$sortField, self::$sortDirection)
            ->paginate($pNum)
            ->appends(request()->query());
    }

    public static function createAdmin($request) {

        $data = $request->input();

        if ($admin = self::create([
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'is_active' => $data['is_active'],
        ])) {
            return $admin;
        }

        return false;
    }

}
