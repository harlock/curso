<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard',
    function () {
    return view('dashboard');
})->name('dashboard');

Route::get("grafica1", [\App\Http\Controllers\GraphicController::class,
    'showGraphic1'])->name("grafica1");
Route::get("grafica_top_5", [\App\Http\Controllers\GraphicController::class,
    'showGraphic2'])->name("grafica_top_5");
Route::get("grafica_comentarios", [\App\Http\Controllers\GraphicController::class,
    'showGraphicComments'])->name("grafica_comentarios");
Route::get("grafica_final", [\App\Http\Controllers\GraphicController::class,
    'showGraphicFinal'])->name("grafica_final");

Route::get("Ariel",function(){
    return view("Ariel.index");
})->name("route_Ariel");