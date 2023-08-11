<?php

use Illuminate\Support\Facades\Route;
use Modules\PermissionManagement\app\Http\Controllers\Permission\PermissionController;
use Modules\PermissionManagement\app\Http\Controllers\Role\RoleController;
use Modules\PermissionManagement\app\Http\Controllers\Route\RouteController;

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

Route::resource('route', RouteController::class)->only('index', 'store', 'update', 'destroy');
Route::resource('role', RoleController::class)->only('index', 'store', 'update', 'destroy');
Route::resource('permission', PermissionController::class)->only('index', 'store', 'update', 'destroy');
