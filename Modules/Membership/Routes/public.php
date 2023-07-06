<?php 

use Illuminate\Support\Facades\Route;

Route::get('membership', 'MembershipController@index')->name('membership.index');
Route::get('membership/{id}/checkout','MembershipController@checkout')->name('membership.checkout')->middleware('auth');
Route::post('membership/{id}/purchase','MembershipController@purchase')->name('membership.purchase')->middleware('auth');




Route::get('faq2', 'MembershipController@faq')->name('home.faq');