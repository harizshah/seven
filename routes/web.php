<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::middleware('auth')->group(function(){
    Route::resource('/todo','TodoController');
    Route::put('/todos/{todo}/complete', 'TodoController@complete')->name('todo.complete');
    Route::delete('/todos/{todo}/incomplete', 'TodoController@incomplete')->name('todo.incomplete');
//});
//Route::get('/todos', 'TodoController@index')->name('todo.index');
//Route::get('/todos/create', 'TodoController@create');
//Route::post('/todos/create', 'TodoController@store');
//Route::patch('/todos/{todo}/update', 'TodoController@update')->name('todo.update');
//Route::get('/todos/{todo}/edit', 'TodoController@edit');
//Route::delete('/todos/{todo}/delete', 'TodoController@delete')->name('todo.delete');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', 'UserController@index');

Auth::routes();
Route::post('/upload', 'UserController@uploadAvatar');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
