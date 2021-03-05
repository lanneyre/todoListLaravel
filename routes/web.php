<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;


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

Route::group(['middleware' => 'web'], function (){

    Route::get('/', [TasksController::class, 'show']);

    Route::get('/tasks/{task}', [TasksController::class, 'edit']);

    Route::put('/tasks', [TasksController::class, 'saveEdit']);

    Route::post('/tasks', [TasksController::class, 'insert']);

    Route::delete('/tasks/{task}', [TasksController::class, 'delete']);


});
