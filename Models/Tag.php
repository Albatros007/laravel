<?php

namespace App\Models;

class Tag extends MainModel
{
    protected $fillable = [
        'title',
        'slug',
        'is_hidden'
    ];
//LIKE A REPOSITORY
//*************************************************************
    public static function DashBoardSearchPgt(array $request, int $pNum)
    {
        self::sortData(self::class);

        $query = self::query();

        if (isset($request['id'])) {
            $query->where('id', '=', $request['id']);
        }

        if (isset($request['title'])) {
            $query->where('title', 'LIKE', '%' . $request['title'] . '%');
        }

        if (isset($request['slug'])) {
            $query->where('slug', 'LIKE', '%' . $request['slug'] . '%');
        }

        if (isset($request['is_hidden']) && $request['is_hidden'] !== false) {
            $query->where('is_hidden', '=', $request['is_hidden']);
        }

        if ($dates = self::prepareDateRangeForSearch($request['created_from'], $request['created_to'])) {
            $query->whereBetween('created_at', $dates);
        }

        return $query->orderBy(self::$sortField, self::$sortDirection)
            ->paginate($pNum)
            ->appends($request);
    }

    public static function addItem($request)
    {
        if ($post = self::create($request)) {
            return $post;
        }

        return  false;
    }

    public static function destroyItem($id)
    {
        if (self::destroy($id)) {
            return true;
        }

        return  false;
    }

    public static function updateItem($request, $id)
    {
        $tag = self::getById($id);

        if ($tag->update($request)) {
            return $tag;
        }

        return  false;
    }

    public static function changeVisibility($id)
    {
        $item = self::find($id);
        $item->is_hidden = empty($item->is_hidden) ? 1 : 0;

        if ($item->save()) {
            return $item;
        }

        return false;
    }

    public static function getById($id)
    {
        return self::find($id);
    }

    public static function getAllPgt($pNum)
    {
        self::sortData(self::class);

        return self::orderBy(self::$sortField, self::$sortDirection)
            ->paginate($pNum)
            ->appends(request()->query());
    }

    public static function getAllPluck($hidden = false, $column = 'title')
    {
        self::sortData(self::class);

        $query = self::query();

        if ($hidden) {
            $query->where('is_hidden', '!=', 1);
        }

        return $query->orderBy(self::$sortField, self::$sortDirection)
            ->pluck($column, 'id');
    }
}


