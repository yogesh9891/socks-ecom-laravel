<?php

use Illuminate\Support\Facades\Route;

Route::get('blogs', [
    'as' => 'admin.blogs.index',
    'uses' => 'BlogController@index',
    'middleware' => 'can:admin.blogs.index',
]);

Route::get('blogs/create', [
    'as' => 'admin.blogs.create',
    'uses' => 'BlogController@create',
    'middleware' => 'can:admin.blogs.create',
]);

Route::post('blogs', [
    'as' => 'admin.blogs.store',
    'uses' => 'BlogController@store',
    'middleware' => 'can:admin.blogs.create',
]);

Route::get('blogs/{id}/edit', [
    'as' => 'admin.blogs.edit',
    'uses' => 'BlogController@edit',
    'middleware' => 'can:admin.blogs.edit',
]);

Route::put('blogs/{id}', [
    'as' => 'admin.blogs.update',
    'uses' => 'BlogController@update',
    'middleware' => 'can:admin.blogs.edit',
]);

Route::delete('blogs/{ids?}', [
    'as' => 'admin.blogs.destroy',
    'uses' => 'BlogController@destroy',
    'middleware' => 'can:admin.blogs.destroy',
]);

// append
