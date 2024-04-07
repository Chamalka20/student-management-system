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
    Route::post('/add',[StudentsController::class, "add"])->name('student.add');
    Route::get('/edit',[StudentsController::class, "edit"])->name('student.edit');
    Route::post('/{studentId}/update',[StudentsController::class, "update"])->name('student.update');
    Route::get('/{studentId}/delete',[StudentsController::class, "delete"])->name('student.delete');
    Route::get('/{studentId}/active',[StudentsController::class, "active"])->name('student.active');
    
});
