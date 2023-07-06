<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\Admin\MembershipController;

Route::get('memberships', [
    'as' => 'admin.memberships.index',
    'uses' => 'MembershipController@index',
    'middleware' => 'can:admin.memberships.index',
]);

Route::get('memberships/create', [
    'as' => 'admin.memberships.create',
    'uses' => 'MembershipController@create',
    'middleware' => 'can:admin.memberships.create',
]);

Route::post('memberships', [
    'as' => 'admin.memberships.store',
    'uses' => 'MembershipController@store',
    'middleware' => 'can:admin.memberships.create',
]);

Route::get('memberships/{id}/edit', [
    'as' => 'admin.memberships.edit',
    'uses' => 'MembershipController@edit',
    'middleware' => 'can:admin.memberships.edit',
]);

Route::put('memberships/{id}', [
    'as' => 'admin.memberships.update',
    'uses' => 'MembershipController@update',
    'middleware' => 'can:admin.memberships.edit',
]);

Route::delete('memberships/{ids?}', [
    'as' => 'admin.memberships.destroy',
    'uses' => 'MembershipController@destroy',
    'middleware' => 'can:admin.memberships.destroy',
]);