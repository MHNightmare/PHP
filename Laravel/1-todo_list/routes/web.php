<?php

use App\Http\Controllers\TaskController;
use App\Http\Requests\Taskrequest;
use App\Models\Task;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\Http\Response as FlareClientHttpResponse;

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

Route::resource('tasks',TaskController::class);


Route::put('task/{task}/toggle-complete', [TaskController::class ,'togglecomplete'])->name('task-toggle');
    