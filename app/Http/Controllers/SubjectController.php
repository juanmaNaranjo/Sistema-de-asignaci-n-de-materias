<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectCreateRequest;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    
    public function index()
    {
        $subjects = Subject::with('teacher')->orderBy('created_at', 'desc')->paginate(6);
        if ($subjects->count() > 0) {
            return response()->json([
                'subjects' => $subjects
            ], 200);
        } else {
            return response()->json([
                'message' => 'No subjects found'
            ], 404);
        }
    }

    public function store(SubjectCreateRequest $request)
    {
        try {
            $subjectExists = Subject::where('name', $request->name)->where('teacher_id', $request->teacher_id)->get();
            if ($subjectExists->count() > 0) {
                return response()->json([
                    'message' => 'Subject already exists for this teacher'
                ], 400);
            }else{
                $subject = Subject::create($request->all());
                return response()->json([
                    'subject' => $subject,
                    'message' => 'Subject created successfully'
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating subject'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $subject = Subject::find($id);
            if ($subject) {
                $subject->delete();
                return response()->json([
                    'message' => 'Subject deleted successfully'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Subject not found'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting subject'
            ], 500);
        }
    }
}
