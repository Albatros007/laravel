@extends('B::layouts.main')

@php

    $columns = [
        'id' => [
            'name' => 'id',
            'tdCSS' => 'text-center',
            'thCSS' => 'text-center',
            'search' => true,
        ],
        'title' => [
            'name' => 'Название',
            'sort' => true,
            'link' => 'categories.edit',
            'search' => true,
        ],
        'created_at' => [
            'name' => 'Создано',
            'sort' => true,
            'dateFormat' => 'd.m.Y',
            'tdCSS' => 'text-center',
            'thCSS' => 'text-center',
            'search' => [
                'values' => [
                    'from' => 'created_from',
                    'to' => 'created_to'
                ],
            ],
        ],
        'updated_at' => [
            'name' => 'Изменено',
            'sort' => true,
            'dateFormat' => 'd.m.Y',
            'tdCSS' => 'text-center',
            'thCSS' => 'text-center',
            'search' => [
                'values' => [
                    'from' => 'updated_from',
                    'to' => 'updated_to'
                ],
            ],
        ],
        'slug' => [
            'name' => 'ЧПУ',
            'search' => true,
            'sort' => true,
        ],
        'is_hidden' => [
            'name' => 'Статус',
            'tdCSS' => 'text-center',
            'itemContent' => function($item){
               $css = ($item->is_hidden == 1) ? "fa-eye-slash" : "fa-eye";
               $html = '<a href="'.route("categories.visibility", $item->id).'">
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

    $model = App\Models\Category::class;

@endphp

@section('content')

    <x-table-creator :items="$categories" :columns="$columns" :model="$model"/>

@endsection
