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

Route::any('login', 'LoginController@login');

Route::middleware('auth:api')->group(function () {
    Route::prefix('author')->group(function() {
        Route::get('me', 'AuthorController@me');
    });

    // api/tierlist
    Route::prefix('tierlist')->group(function() {
        Route::get('', 'TierlistController@index');
        Route::get('popular', 'TierlistController@popularIndex');
        Route::get('friends', 'TierlistController@friendIndex');

        // api/tierlist/{id}/
        Route::prefix('{id}')->group(function () {
            Route::get('', 'TierlistController@show');

            // api/tierlist/{id}/opinion
            Route::prefix('opinion')->group(function () {
                Route::get('all', 'OpinionController@show');
                Route::get('my', 'OpinionController@showMe');
                Route::get('author', 'OpinionController@showAuthor');

                Route::post('', 'OpinionItemController@store');
                Route::patch('', 'OpinionItemController@update');
            });
        });

        Route::post('', 'TierlistController@store');
    });
});
