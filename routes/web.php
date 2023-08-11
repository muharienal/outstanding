<?php

use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ActivityLogController;
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

Route::permanentRedirect('/', '/login');

Route::resource('libraries', LibraryController::class);

Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity-log.index');

