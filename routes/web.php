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
    // return view('welcome');
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/workouts', 'WorkoutController@index')->middleware('auth');
Route::post('/workouts', 'WorkoutController@store')->middleware('auth');
Route::get('/workouts/create', 'WorkoutController@create')->middleware('auth');
Route::get('/workouts/{workout}', 'WorkoutController@show')->middleware('auth');
Route::delete('/workouts/{workout}', 'WorkoutController@destroy')->middleware('auth');

// Route::get('/articles/{article}/edit', 'ArticlesController@edit')->middleware('auth');
// Route::put('/articles/{article}', 'ArticlesController@update')->middleware('auth');
// Route::delete('/articles/{article}', 'ArticlesController@destroy')->middleware('auth');

Route::post('/workoutlogs', 'WorkoutlogController@store')->middleware('auth');
Route::get('/workoutlogs/{workout}/create', 'WorkoutlogController@create')->middleware('auth');
Route::get('/workoutlogs/{workoutlog}/edit', 'WorkoutlogController@edit')->middleware('auth');
Route::put('/workoutlogs/{workoutlog}', 'WorkoutlogController@update')->middleware('auth');
Route::delete('/workoutlogs/{workout}', 'WorkoutlogController@destroy')->middleware('auth');
