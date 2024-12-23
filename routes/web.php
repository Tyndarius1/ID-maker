<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/student-id/{student_fullname}', [App\Http\Controllers\StudentController::class, 'index'])->name('layouts.student-id');
Route::get('/employee-id/{employee_fullname}', [App\Http\Controllers\EmployeeController::class, 'employee'])->name('layouts.employee-id');
