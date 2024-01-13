<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

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

// Route::get('/', function (){
//     return view('home');
// });

Route::get('/', [NewsController::class, 'load']);
Route::get('/home', [NewsController::class, 'load']);
Route::get('/news', [NewsController::class, 'load']);
Route::get('/news/technology', [NewsController::class, 'loadTechNews']);
Route::get('/news/sport', [NewsController::class, 'loadSportNews']);
Route::get('/saved', [NewsController::class, 'loadSavedNews']);

Route::post('/addReadLater', [NewsController::class, 'addReadLater'])->name('addReadLater');

Auth::routes();
