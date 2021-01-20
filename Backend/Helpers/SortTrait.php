<?php


namespace App\Backend\Helpers;


use App\Models\Tag;

trait SortTrait
{
    /**
     * Поле сортировки по умолчанию
     */
    protected static $sortField = '-'.self::CREATED_AT;

    /**
     * Направление сортировки по умолчанию. Принимает значения либо DESC либо ASC.
     */
    protected static $sortDirection = 'DESC';

    /**
     * Массив разрешенных для сортировки полей. Если установленн В false, разрешенные поля берутся из
     * массива $fillable модели(далее к ним добавляются поля created_at и updated_at).
     */
    protected static $sortProtectedFields = false;

    //Setters
    public static function setSortField(string $sortField)
    {
        self::$sortField = $sortField;
    }

    public static function setSortDirection(string $sortDirection)
    {
        self::$sortDirection = $sortDirection;
    }

    public static function setSortProtectedFields(array $sortProtectedFields)
    {
        self::$sortProtectedFields = $sortProtectedFields;
    }

    //Getters
    public static function getSortField()
    {
       return self::$sortField;
    }

    public static function getSortDirection()
    {
        return self::$sortDirection;
    }

    public static function getSortProtectedFields()
    {
        return self::$sortProtectedFields;
    }

    protected static function sortData($model)
    {
        self::$sortField = request('sort') ?? self::$sortField;

        if (!self::$sortProtectedFields) {
            $model = new $model;
            $protected = array_merge($model->fillable, [self::CREATED_AT, self::UPDATED_AT]);
        } else {
            $protected = self::$sortProtectedFields;
        }

        $field = str_replace('-', '', self::$sortField);

        if (!in_array($field, $protected)) {
            abort(404);
        }

        if (!strstr(self::$sortField, '-')) {
            self::$sortDirection = 'ASC';
        }

        self::$sortField = $field;
    }
}
