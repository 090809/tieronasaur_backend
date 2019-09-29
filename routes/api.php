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
        Route::get('{author}', 'AuthorController@show');
        Route::get('{author}/tierlist', 'AuthorController@tierlists');
        Route::get('', 'AuthorController@index');
        Route::get('me', 'AuthorController@me');
    });

    // api/tierlist
    Route::prefix('tierlist')->group(function() {
        Route::get('', 'TierlistController@index');
        Route::get('popular', 'TierlistController@popularIndex');
        Route::get('friends', 'TierlistController@friendIndex');

        // api/tierlist/{tierlist}/
        Route::prefix('{tierlist}')->group(function () {
            Route::get('', 'TierlistController@show');
            Route::post('karma', 'TierlistKarmaController@karma');

            // api/tierlist/{tierlist}/opinion
            Route::prefix('opinion')->group(function () {
                Route::prefix('all')->group(function() {
                    Route::get('', 'OpinionController@show');
                    Route::get('preview', 'PreviewController@show');
                });

                Route::prefix('my')->group(function() {
                    Route::get('', 'OpinionController@showMe');
                    // api/tierlist/{tierlist}/opinion/my/preview
                    Route::get('preview', 'PreviewController@showMe');
                });
                Route::prefix('author')->group(function() {
                    Route::get('', 'OpinionController@showAuthor');
                    Route::get('preview', 'PreviewController@showAuthor');
                });

                Route::post('', 'OpinionItemController@store');
                Route::patch('', 'OpinionItemController@update');
            });
        });

        Route::post('', 'TierlistController@store');
    });

    Route::prefix('tag')->group(function() {
        Route::get('', 'TagController@index');
        Route::get('find', 'TagController@find');
        Route::post('', 'TagController@store');
    });
});

// Last Commit 11:59
