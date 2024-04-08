<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentsController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/',[HomeController::class, "index"])->name("home");

Route ::prefix('/students') ->group(function (){
    Route::get('/',[StudentsController::class, "index"])->name('students');
    Route::get('/list',[StudentsController::class, "list"])->name('student.list');
    Route::post('/add',[StudentsController::class, "add"])->name('student.add');
    Route::get('/{studentId}/get',[StudentsController::class, "get"])->name('student.get');
    Route::post('/{studentId}/update',[StudentsController::class, "update"])->name('student.update');
    Route::get('/{studentId}/delete',[StudentsController::class, "delete"])->name('student.delete');
    Route::get('/{studentId}/active',[StudentsController::class, "active"])->name('student.active');
    
});
