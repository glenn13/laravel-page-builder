<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::any('/admin/pages/{id}/build', 'App\Http\Controllers\PageBuilderController@build')->name('pagebuilder.build');
Route::any('/admin/pages/build', 'App\Http\Controllers\PageBuilderController@build');
// Route::any('/admin/pages/{id}/viewPage', 'App\Http\Controllers\PageBuilderController@viewPage');
Route::any('/adminx/viewPage', function () {
    return "asd";
});

// Route::any('about-us', function () {
//     return [1,2,3];
// });
Route::any('/{uri}', [
    'uses' => 'App\Http\Controllers\WebsiteController@uri',
    'as' => 'page',
])->where('uri', '.*');