<?php

use App\Http\Controllers\CSM\AcademicClassController;
use App\Http\Controllers\CSM\AcademicClassStudentController;
use App\Http\Controllers\CSM\AcademicClassStudentPaymentController;
use App\Http\Controllers\CSM\DepartmentController;

use Illuminate\Support\Facades\Route;

Route::get('/departments', [DepartmentController::class, 'index']);
Route::get('/departments/academic-sessions/{academicSession}', [DepartmentController::class, 'show']);

Route::get('/academic-classes/{academic_class}/students', [AcademicClassController::class, 'students']);

Route::get('/academic-classes/{academic_class}/students/{student}', [AcademicClassStudentController::class, 'show']);

Route::get('/academic-classes/{academic_class}/students/{student}/payments', [AcademicClassStudentPaymentController::class, 'index']);
Route::post('/academic-classes/{academic_class}/students/{student}/payments', [AcademicClassStudentPaymentController::class, 'store']);
Route::get('/academic-classes/{academic_class}/students/{student}/payments/{payment}', [AcademicClassStudentPaymentController::class, 'show']);