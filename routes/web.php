<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => '{locale?}',
    'where' => ['locale' => 'nl|en'],
    'namespace' => 'App\Http\Controllers',
    'middleware' => ['set.default.url.locale']
], function() {
    Route::get("/", 'SiteController@home')->name('home');
    Route::get("/test", 'SiteController@test')->name('test');
});