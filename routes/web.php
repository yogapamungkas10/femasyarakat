<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\MasyarakatController;

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

Route::get('/masyarakats', [MasyarakatController::class, 'index']);
Route::post('/masyarakats/store', [MasyarakatController::class, 'store']);
Route::get('/', [MasyarakatController::class, 'createToken']);
Route::get('/masyarakats/{id}', [MasyarakatController::class, 'show']);
Route::patch('/masyarakats/{id}/update', [MasyarakatController::class, 'update']);
Route::delete('/masyarakats/{id}/delete', [MasyarakatController::class, 'destroy']);