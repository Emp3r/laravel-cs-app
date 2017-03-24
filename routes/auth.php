<?php

// Authentication Routes
Route::get('prihlasit', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('prihlasit', 'Auth\LoginController@login');
Route::post('odhlasit', 'Auth\LoginController@logout')->name('logout');

// Registration Routes
Route::get('registrace', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('registrace', 'Auth\RegisterController@register');
Route::get('registrace/overeni/{token}', 'Auth\RegisterController@confirmEmail');

// Password Reset Routes
Route::get('heslo/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('heslo/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('heslo/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('heslo/reset', 'Auth\ResetPasswordController@reset');

// User Profile & Management Routes
Route::get('uzivatel/nastaveni', 'UsersController@edit')->name('settings');
Route::get('uzivatel/nastaveni/email', 'UsersController@editEmail')->name('settings.email');
Route::get('uzivatel/nastaveni/heslo', 'UsersController@editPassword')->name('settings.password');

Route::get('uzivatel/{user}', 'UsersController@show')->name('user.profile');
Route::put('uzivatel/nastaveni', 'UsersController@update')->name('user.update');
Route::put('uzivatel/nastaveni/email', 'UsersController@updateEmail')->name('user.update.email');
Route::put('uzivatel/nastaveni/heslo', 'UsersController@updatePassword')->name('user.update.password');
