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
 
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('todos/index', [App\Http\Controllers\TodoController::class, 'index'])->name('todos.index');
Route::get('todos/create', [App\Http\Controllers\TodoController::Class, 'create'])->name('todos.create');
Route::post('todos/store',[App\Http\Controllers\TodoController::class, 'store'])->name('todos.store1');
Route::get('todos/edit/{id}', [App\Http\Controllers\TodoController::class, 'edit'])->name('todos.edit');
Route::get('todos/view/{id}', [App\Http\controllers\TodoController::class, 'view'])->name('todos.view');
Route::post('todos/update',[App\Http\Controllers\TodoController::class, 'update'])->name('todos.update');
Route::get('todos/delete/{id}', [App\Http\controllers\TodoController::class, 'delete'])->name('todos.delete');
