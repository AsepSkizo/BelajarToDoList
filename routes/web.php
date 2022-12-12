<?php

use App\Http\Controllers\ListModelController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [ListModelController::class, 'index']);
Route::get('/all-lists', [ListModelController::class, 'showAll'])->name('list.showAll');
Route::post('/list-done', [ListModelController::class, 'done'])->name('list.done');
Route::post('/list-delete', [ListModelController::class, 'delete'])->name('list.delete');
Route::post('/list-update', [ListModelController::class, 'update'])->name('list.update');
Route::post('/list-store', [ListModelController::class, 'store'])->name('list.store');
