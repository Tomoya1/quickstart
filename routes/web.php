<?php

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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


// 認証ルート…
Route::get('auth/login', 'Auth\LoginController@getLogin');
Route::post('auth/login', 'Auth\LoginController@postLogin');
Route::get('auth/logout', 'Auth\LoginController@getLogout');

// 登録ルート…
Route::get('auth/register', 'Auth\RegisterController@getRegister');
Route::post('auth/register', 'Auth\RegisterController@postRegister');

Route::get('/tasks', 'TasksController@index');
Route::post('/task', 'TasksController@store');
Route::delete('/task/{task}', 'TasksController@destroy');
//Route::delete('/task/{task}', 'TasksController@destroy');


//// 既存のタスクを削除
//Route::delete('/task/{id}', function ($id) {
//    Task::findOrFail($id)->delete();
//
//    return redirect('/');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
