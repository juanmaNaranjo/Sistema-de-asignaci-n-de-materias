<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnrollmentCreateRequest;
use App\Models\Enrollment;
use App\Models\sClass;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with('student', 'sClass')->orderBy('created_at', 'desc')->paginate(6);
        if ($enrollments->count() > 0) {
            return response()->json([
                'enrollments' => $enrollments
            ], 200);
        } else {
            return response()->json([
                'message' => 'No enrollments found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        // Obtener las clases que tiene el estudiante y obtener la materia de cada clase
        $subjects = Student::with('studentClasses.sClass.subject')->where('id', $request->student_id)->get();
        // Recorrer las materias y obtener los creditos de cada materia
        $totalCredits = 0;
        $idClasses = [];
        foreach ($subjects as $subject) {
            foreach ($subject->studentClasses as $sClass) {
                $totalCredits += $sClass->sClass->subject->credits;
                $idClasses[] = $sClass->sClass->id;
            }
        }
        if ($totalCredits < 7) {
            return response()->json([
                'message' => 'Tú no puedes matricularte, necesitas al menos 7 créditos, tienes ' . $totalCredits . ' créditos en total, inscríbete en más clases'
            ], 401);
        } else {
            try {
                $enrollment = new Enrollment();
                $enrollment->student_id = $request->student_id;
                $enrollment->all_sclasses = json_encode($idClasses);
                $enrollment->date_enrolled = $request->date_enrolled;
                // Comprobar si el estudiante ya cuenta con una matricula
                $enrollmentExists = Enrollment::where('student_id', $request->student_id)->get();
                if ($enrollmentExists->count() > 0) {
                    return response()->json([
                        'message' => 'El estudiante ya cuenta con una matricula'
                    ], 400);
                } else {
                    $enrollment->save();
                    return response()->json([
                        'enrollment' => $enrollment,
                        'message' => 'Enrollment created successfully'
                    ], 201);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Error creating enrollment'
                ], 500);
            }
        }
    }
}
