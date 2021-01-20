@extends('B::layouts.main')

@php

    $columns = [
        /*'id' => [
            'name' => 'id',
            'tdCSS' => 'text-center',
        ],*/
        'name' => [
            'name' => 'Имя',
            'sort' => true,
            'link' => 'admins.edit',
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
        'is_active' => [
            'name' => 'Статус',
            'tdCSS' => 'text-center',
            /*'itemContent' => function($item){
               $css = ($item->is_hidden == 1) ? "fa-eye-slash" : "fa-eye";
               $html = '<a href="'.route("admins.visibility", $item->id).'">
                            <span class="fa '.$css.' fa-2x" aria-hidden="true"></span>
                        </a>';
               return $html;
            },*/
            'search' => [
                'type' => 'select',
                'values' => [
                    0 => 'Не активен',
                    1 => 'Активен'
                ],
            ],
            'sort' => true,
        ],
        '!!remove' => [
            'name' => 'Удалить',
        ],
    ];

    $model = App\Models\Admin::class;

@endphp

@section('content')

    <x-table-creator :items="$admins" :columns="$columns" :model="$model"/>

@endsection
