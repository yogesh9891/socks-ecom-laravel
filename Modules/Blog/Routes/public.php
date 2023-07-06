<?php

use Illuminate\Support\Facades\Route;

Route::get('blog', 'BlogController@index')->name('blogs.index');

Route::get('blog/{blog}', 'BlogController@singlePage')->name('blogs.single.index');
