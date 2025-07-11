<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
Route::get('/',[StudentController::class, 'index'])->name('index');
Route::resource("students", StudentController::class);