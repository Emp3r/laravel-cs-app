<?php

// Authentication Routes...
Route::get('prihlasit', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('prihlasit', 'Auth\LoginController@login');
Route::post('odhlasit', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('registrace', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('registrace', 'Auth\RegisterController@register');
Route::get('registrace/overeni/{token}', 'Auth\RegisterController@confirmEmail');

// Password Reset Routes...
Route::get('heslo/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('heslo/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('heslo/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('heslo/reset', 'Auth\ResetPasswordController@reset');
