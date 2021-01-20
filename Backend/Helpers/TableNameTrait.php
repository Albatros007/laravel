<?php


namespace App\Backend\Helpers;


trait TableNameTrait
{
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
