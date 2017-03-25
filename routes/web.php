<?php

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index');

Route::get('home', function () {
    return redirect('/');
});
