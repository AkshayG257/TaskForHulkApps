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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    /**User Switch */
    // Route::get('dashboard',[UserController::class, 'login'])->name('dashboard');
    Route::get('/home', [App\Http\Controllers\AppointmentsController::class, 'index'])->name('home');
    Route::get('/add_new_appointment', [App\Http\Controllers\AppointmentsController::class, 'add_new_appointment'])->name('add_new_appointment');
    Route::post('/add_new_appointment_post', [App\Http\Controllers\AppointmentsController::class, 'add_new_appointment_post'])->name('add_new_appointment_post');
    Route::post('/delete_appointment', [App\Http\Controllers\AppointmentsController::class, 'delete_appointment'])->name('delete_appointment');
    Route::post('/finish_appointment', [App\Http\Controllers\AppointmentsController::class, 'finish_appointment'])->name('finish_appointment');
    Route::post('/accept_appointment', [App\Http\Controllers\AppointmentsController::class, 'accept_appointment'])->name('accept_appointment');
    Route::post('/reject_appointment', [App\Http\Controllers\AppointmentsController::class, 'reject_appointment'])->name('reject_appointment');

    Route::get('/manage_users', [App\Http\Controllers\HomeController::class, 'manage_users'])->name('manage_users');
    Route::get('/add_new_user', [App\Http\Controllers\HomeController::class, 'add_new_user'])->name('add_new_user');
    Route::post('/add_new_user_post', [App\Http\Controllers\HomeController::class, 'add_new_user_post'])->name('add_new_user_post');
    Route::post('/delete_user', [App\Http\Controllers\HomeController::class, 'delete_user'])->name('delete_user');

    
});

Route::get('/checkavailability', [App\Http\Controllers\AppointmentsController::class, 'checkavailability'])->name('checkavailability');

