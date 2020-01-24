<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get_books', 'BookController@getAllBooks');

Route::get('/get_single_book/{id}', 'BookController@single_book');

Route::post('/create_author', 'BookController@create_author')->name('CreateAuthor');

Route::post('/create_book', 'BookController@create_book')->name('CreateBook');
