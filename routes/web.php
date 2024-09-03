<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserLoginController;
use App\Http\Controllers\DoctorController;

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



Route::get('/', [UserLoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [UserLoginController::class, 'login']);
Route::get('dashboard', [UserLoginController::class, 'dashboard'])->name('dashboard')->middleware('auth');
// Route::get('add-doctor', [UserLoginController::class, 'addDoctor'])->name('add-doctor')->middleware('auth');
Route::get('/doctor-list', [UserLoginController::class, 'doctorList'])->name('doctor.list');
Route::get('/doctor-list', [UserLoginController::class, 'doctorList'])->name('doctor.list');
Route::get('/profile', [UserLoginController::class, 'showProfile'])->middleware('auth')->name('profile');
Route::get('/logout', [UserLoginController::class, 'logout'])->name('logout');


Route::get('doctor-list', [DoctorController::class, 'index'])->name('doctor-list');
Route::get('add-doctor', [DoctorController::class, 'create'])->name('doctor.form');
Route::post('add-doctor', [DoctorController::class, 'store'])->name('doctor.store');
Route::get('doctor-profile/{id}', [DoctorController::class, 'show'])->name('doctor-profile');
Route::get('doctors/delete/{id}', [DoctorController::class, 'destroy'])->name('doctor-delete');


// Route to show the Thank You page
Route::get('thankyou', [DoctorController::class, 'thankYou'])->name('thankyou');
