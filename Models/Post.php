<?php

namespace App\Models;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Post extends MainModel
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    protected $fillable = [
        'title',
        'meta_keywords',
        'meta_description',
        'content',
        'category_id',
        'views',
        'slug',
        'is_hidden'
    ];
//LIKE A REPOSITORY
//*************************************************************
    public static function getAllPgt($pNum)
    {
        self::sortData(self::class);

        return self::orderBy(self::$sortField, self::$sortDirection)
            ->paginate($pNum)
            ->appends(request()->query());
    }

    public static function addItem($request)
    {
        DB::beginTransaction();
        try {
            $post = Post::create($request);
            $post->tags()->sync($request['tags']);
        }catch(QueryException $e) {
            DB::rollBack();
        }
        DB::commit();

        return  true;
    }

    public static function destroyItem($id)
    {
        DB::beginTransaction();
            try {
                $post = self::getById($id);
                $post->destroy($id);
                $post->tags()->sync([]);
            }catch(QueryException $e) {
                DB::rollBack();
            }
        DB::commit();

        return true;
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
}
