<?php

use App\Contact;
use Illuminate\Http\Request;

// Grouping allows us to apply the authentication to all CRUD operations
Route::middleware('auth:api')->group(function () {
    Route::prefix('contacts')->group(function () {
        Route::get('/', 'ContactsController@index');
        Route::get('/{contact}', 'ContactsController@show');
        Route::post('/', 'ContactsController@store');
        Route::put('/{contact}', 'ContactsController@update');
        Route::delete('/{contact}', 'ContactsController@destroy');
    });
  
    Route::get('/birthdays', 'BirthdaysController@index');

    Route::post('/search', 'SearchController@index');

    Route::get('/homepage', 'HomeController@show');
});