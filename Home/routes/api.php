<?php

use Illuminate\Http\Request;

// Grouping allows us to apply the authentication to all CRUD operations
Route::middleware('auth:api')->group(function () {
    Route::get('/contacts', 'ContactsController@index');
    Route::get('/contacts/{contact}', 'ContactsController@show');
    Route::post('/contacts', 'ContactsController@store');
    Route::put('/contacts/{contact}', 'ContactsController@update');
    Route::delete('/contacts/{contact}', 'ContactsController@destroy');

    Route::get('birthdays', 'BirthdaysController@index');

    Route::post('search', 'SearchController@index');
});