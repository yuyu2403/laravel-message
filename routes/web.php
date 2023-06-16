<?php

use App\Http\Controllers\MessageBoard;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/MessageBoard', [MessageBoard::class, 'index']);

Route::post('/MessageBoard/confirm', [MessageBoard::class, 'confirm']);
Route::get('/MessageBoard/complete', function () {
    return view('MessageBoard.complete');
});
Route::get('/MessageBoard/list/', [MessageBoard::class, 'list']);
Route::post('/MessageBoard/delete/{id}', [MessageBoard::class, 'delete']);
Route::get('/MessageBoard/edit/{id}', [MessageBoard::class, 'edit']);
Route::post('/MessageBoard/edit/{id}', [MessageBoard::class, 'update']);
