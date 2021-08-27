<?php

use App\Http\Controllers\AlbumController;
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

Route::get('/', [AlbumController::class,'index']);
Route::get('/album-create', [AlbumController::class,'create']);
Route::post('/album-store', [AlbumController::class,'store']);
Route::get('/album/{id}/edit', [AlbumController::class,'edit']);
Route::put('/album/{id}/update', [AlbumController::class,'update']);
Route::delete('/album/{id}/delete', [AlbumController::class,'destroy']);