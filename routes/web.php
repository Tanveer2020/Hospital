<?php

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

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

 Auth::routes([
     'verify' => true
 ]);


Route::get('/home',[HomeController::class, 'redirect'])->middleware('verified');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/add_doctor_view',[AdminController::class,'addview']);

Route::post('/upload_doctor',[AdminController::class,'upload']);

Route::post('/appointment',[HomeController::class,'appointment']);

Route::get('/myappointment',[HomeController::class, 'myappointment']);

Route::get('/cancel_appoint/{id}',[HomeController::class, 'cancel_appoint']);

Route::get('/show_appointment',[AdminController::class, 'show_appointment']);

Route::get('/approved/{id}',[AdminController::class, 'approved']);

Route::get('/canceled/{id}',[AdminController::class, 'canceled']);

Route::get('/showdoctor',[AdminController::class, 'showdoctor']);
 
Route::get('/updatedoctor/{id}',[AdminController::class,'updatedoctor']);

Route::get('/deletedoctor/{id}',[AdminController::class,'deletedoctor']);

Route::post('/editdoctor/{id}',[AdminController::class,'editdoctor']);

Route::get('/emailview/{id}',[AdminController::class, 'emailview']);

Route::post('/sendmail/{id}',[AdminController::class,'sendmail']);










