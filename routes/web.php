<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

$real_path = realpath(__DIR__) . DIRECTORY_SEPARATOR;
include_once($real_path . 'admin.php');

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])
->name('dashboard');

Route::get('/about', [App\Http\Controllers\DashboardController::class, 'about'])
->name('about');

Route::get('/volunteer', [App\Http\Controllers\DashboardController::class, 'volunteer'])
->name('volunteer');


Route::get('/causes', [App\Http\Controllers\DashboardController::class, 'causes'])
->name('causes');

Route::get('/contact', [App\Http\Controllers\DashboardController::class, 'contact'])
->name('contact');

Route::post('/contact/submit', [App\Http\Controllers\DashboardController::class, 'contactSend'])
->name('contact.submit');

Route::post('/donate/stripe', [App\Http\Controllers\DashboardController::class, 'donate'])
->name('donate.stripe');