<?php

namespace App\Models;


class DBMainMenu extends MainModel
{
    protected $table = 'db_main_menu';

    public static function getMenu()
    {
        return self::all();
    }
}
