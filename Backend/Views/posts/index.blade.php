@extends('B::layouts.main')

@php
    $columns = [
        /*'id' => [
            'name' => 'id',
            'tdCSS' => 'text-center',
            'thCSS' => 'text-center',
            'search' => true,
        ],*/
        'title' => [
            'name' => 'Название',
            'sort' => true,
            'link' => 'posts.edit',
            'search' => true,
        ],
        'tags' => [
            'name' => 'Тэги',
            'itemContent' => function($item){
               return $item->tags->pluck('title')->join(', ');
            },
        ],
        'created_at' => [
            'name' => 'Создано',
            'sort' => true,
            'dateFormat' => true,
            'tdCSS' => 'text-center',
            'thCSS' => 'text-center',
            'search' => [
                'values' => [
                    'from' => 'created_from',
                    'to' => 'created_to'
                ],
            ],
        ],
        'is_hidden' => [
            'name' => 'Статус',
            'tdCSS' => 'text-center',
            'itemContent' => function($item){
               $css = ($item->is_hidden == 1) ? "fa-eye-slash" : "fa-eye";
               $html = '<a href="'.route("posts.visibility", $item->id).'">
                            <span class="fa '.$css.' fa-2x" aria-hidden="true"></span>
                        </a>';
               return $html;
            },
            'search' => [
                'type' => 'select',
                'values' => [
                    0 => 'Открыто',
                    1 => 'Скрыто'
                ],
            ],
            'sort' => true,
        ],
        '!!remove' => [
            'name' => 'Удалить',
        ],
    ];

    $model = App\Models\Post::class;
@endphp

@section('content')

    <x-table-creator :items="$posts" :columns="$columns" :model="$model"/>

@endsection
