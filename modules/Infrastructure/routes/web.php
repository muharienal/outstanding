<?php

use Illuminate\Support\Facades\Route;
use Modules\Infrastructure\app\Http\Controllers\InfrastructureController;

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

Route::resource('infrastructure', InfrastructureController::class); // all method was used

Route::get('infrastructure/{infrastructure}/revisi', [InfrastructureController::class, 'revisi_create'])
    ->name('infrastructure.revisi.create');
Route::post('infrastructure/{infrastructure}/revisi', [InfrastructureController::class, 'revisi_store'])
    ->name('infrastructure.revisi.store');
