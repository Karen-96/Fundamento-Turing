<?php

use App\Http\Controllers\Turing\TuringController;
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
    return view('turing.presentacion');
});
Route::get('/turing',[TuringController::class,'presentacion'])->name('turing.presentacion');

Route::get('/turing/configuracion',[TuringController::class,'configuracion'])->name('turing.configuracion');
Route::post('/turing/configuracion/guardar',[TuringController::class,'configuracionGuardar'])->name('turing.import.excel');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
