<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentCreateRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('studentClasses')->orderBy('created_at', 'desc')->paginate(4);
        if ($students->count() > 0) {
            return response()->json([
                'students' => $students
            ], 200);
        } else {
            return response()->json([
                'message' => 'No students found'
            ], 404);
        }
    }

    // obtener las materias que tiene el estudiante
    public function showSubjects($id)
    {
        $student = Student::with('studentClasses.sClass.subject')->where('id', $id)->get();
        $subjects = [];
        foreach ($student[0]->studentClasses as $studentClass) {
            $subjects[] = $studentClass->sClass->subject;
            $subjects[count($subjects) - 1]['teacherName'] = $studentClass->sClass->teacher->name . ' ' . $studentClass->sClass->teacher->lastname;
        }
        if ($student->count() > 0) {
            return response()->json([
                'subjects' => $subjects
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Student found'
            ], 404);
        }
    }

    public function showStudentsClass($dni)
    {
        $student = Student::with('studentClasses.sClass')->where('dni', $dni)->get();
        $classes = [];
        foreach ($student[0]->studentClasses as $studentClass) {
            $classes[] = $studentClass->sClass;
            $classes[count($classes) - 1]['teacherName'] = $studentClass->sClass->teacher->name . ' ' . $studentClass->sClass->teacher->lastname;
            $classes[count($classes) - 1]['subjectName'] = $studentClass->sClass->subject->name;
            $classes[count($classes) - 1]['studentId'] = $student[0]->id;
        }
        if ($student->count() > 0) {
            return response()->json([
                'classes' => $classes
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Student found'
            ], 404);
        }
    }

    public function store(StudentCreateRequest $request)
    {
        try {
            $student = Student::create($request->all());
            return response()->json([
                'student' => $student,
                'message' => 'Student created successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating student'
            ], 500);
        }
    }

    public function show()
    {
        $students = Student::orderBy('name', 'asc')->get();
        if ($students->count() > 0) {
            return response()->json([
                'students' => $students
            ], 200);
        } else {
            return response()->json([
                'message' => 'No Student found'
            ], 404);
        }
    }
}
