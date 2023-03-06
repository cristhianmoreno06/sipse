<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\KidController;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * Rutas estudiantes
 */
Route::get('/kids/list', [KidController::class, 'index'])->name('kids.list');
Route::get('/kids/create', [KidController::class, 'create'])->name('kids.create');
Route::post('/kids/store', [KidController::class, 'store'])->name('kids.store');
Route::get('/kids/{kid}/edit', [KidController::class, 'edit'])->name('kids.edit');
Route::put('/kids/{kid}', [KidController::class, 'update'])->name('kids.update');
Route::delete('/kids/delete/{kid}', [KidController::class, 'destroy'])->name('kids.delete');

/**
 * Rutas cursos
 */
Route::get('/course/list', [CourseController::class, 'index'])->name('course.list');
Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
Route::post('/course/store', [CourseController::class, 'store'])->name('course.store');
Route::get('/course/{course}/edit', [CourseController::class, 'edit'])->name('course.edit');
Route::put('/course/{course}', [CourseController::class, 'update'])->name('course.update');
Route::delete('/course/delete/{course}', [CourseController::class, 'destroy'])->name('course.delete');

/**
 * Rutas reportes
 */
Route::get('/report/kids', [KidController::class, 'report'])->name('report.kids');
