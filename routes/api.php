<?php

use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\SClassController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('students', StudentController::class);
Route::apiResource('teachers', TeacherController::class);
Route::apiResource('subjects', SubjectController::class);
Route::apiResource('sClasses', SClassController::class);
Route::apiResource('student-classes', StudentClassController::class);
Route::apiResource('enrollments', EnrollmentController::class);

Route::get('teachers/subjects/{id}', [TeacherController::class, 'showSubjects']);
Route::get('students/subjects/{id}', [StudentController::class, 'showSubjects']);

Route::get('students/classes/{dni}', [StudentController::class, 'showStudentsClass']);

