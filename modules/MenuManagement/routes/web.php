<?php

use Illuminate\Support\Facades\Route;
use Modules\MenuManagement\app\Http\Controllers\MenuGroupController;
use Modules\MenuManagement\app\Http\Controllers\MenuItemController;

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

Route::resource('menu', MenuGroupController::class)->only('index', 'store', 'update', 'destroy');
Route::resource('menu.item', MenuItemController::class)->only('index', 'store', 'update', 'destroy');
