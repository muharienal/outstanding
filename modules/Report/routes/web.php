<?php

use Illuminate\Support\Facades\Route;
use Modules\Report\app\Http\Controllers\ReportController;

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

Route::resource('report', ReportController::class)->only('index', 'store', 'update', 'destroy');
Route::get('report/filter', [ReportController::class, 'filter'])->name('report.filter');
Route::get('/report/index_alternate', [ReportController::class, 'indexAlternate'])->name('report.indexAlternate');
