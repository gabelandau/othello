<?php



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

Route::get('test', function () {
    //
});

// Event Routes
Route::post('messages', 'MessageController@store');
Route::get('messages/{game}', 'MessageController@getPrevious');

Route::get('invites', 'InviteController@getPrevious');
Route::post('invites', 'InviteController@store');
Route::post('invite/{id}/accept', 'InviteController@accept');

Route::get('games', 'GameController@list');
Route::get('game/{id}', 'GameController@show');
Route::post('game/{id}/addPiece', 'GameController@makeMove');

// Browser Routes
Route::get('', 'HomeController@index')->name('home');

// Authentication Routes
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => '', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

// Registration Routes
Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
Route::post('register', ['as' => '', 'uses' => 'Auth\RegisterController@register']);
