<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'admin',
    'namespace' => 'App\Backend\Controllers',
    'middleware' => ['web', 'auth:admin']
], function (){

    Route::get('admin-logout', 'AuthController@logout')->name('admin.logout');

    Route::resource('admins', 'AdminsController')
        ->except(['show']);

    Route::get('categories/search', 'CategoriesController@search')
        ->name('categories.search');
    Route::get('categories/visibility/{id}', 'CategoriesController@visibility')
        ->name('categories.visibility');
    Route::resource('categories', 'CategoriesController')
        ->except(['show']);

    Route::get('tags/search', 'TagsController@search')
        ->name('tags.search');
    Route::get('tags/visibility/{id}', 'TagsController@visibility')
        ->name('tags.visibility');
    Route::resource('tags', 'TagsController')
        ->except(['show']);

    Route::get('posts/search', 'PostsController@search')
        ->name('posts.search');
    Route::get('posts/visibility/{id}', 'PostsController@visibility')
        ->name('posts.visibility');
    Route::resource('posts', 'PostsController')
        ->except(['show']);

});

Route::group([
    'prefix' => 'admin',
    'namespace' => 'App\Backend\Controllers',
    'middleware' => 'web'
], function (){

    Route::get('login', 'AuthController@form')->name('admin.form');
    Route::post('login', 'AuthController@login')->name('admin.login');

});

